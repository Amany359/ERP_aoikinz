<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreMessageRequest;
use App\Services\MessageService;
use App\Helpers\Helpers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function store(StoreMessageRequest $request)
    {
        $sender = Auth::user();
        $receiver = User::find($request->receiver_id);

        if (!$receiver) {
            return Helpers::jsonResponse(false, null, 'المستخدم غير موجود', 404);
        }

        // التحقق من أن المرسل والمستقبل لهما نفس الدور
        if ($sender->role !== $receiver->role) {
            return Helpers::jsonResponse(false, null, 'لا يمكنك إرسال رسالة إلى مستخدم بدور مختلف', 403);
        }

        // إنشاء الرسالة
        $message = new Message([
            'sender_id'   => $sender->id,
            'receiver_id' => $receiver->id,
            'message'     => $request->message,
            'role'        => $sender->role, // إضافة دور المرسل
    ]);

        $message->save();

        // بث الرسالة عبر WebSockets
        broadcast(new MessageSent($message))->toOthers();

        return Helpers::jsonResponse(true, $message, 'تم إرسال الرسالة بنجاح', 201);
    }

    public function index()
    {
        $user = Auth::user();

        // جلب الرسائل التي يكون المستخدم طرفًا فيها
        $messages = Message::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender:id,name', 'receiver:id,name'])
            ->orderBy('created_at', 'asc')
            ->get();

        return Helpers::jsonResponse(true, $messages, 'تم جلب جميع الرسائل بنجاح', 200);
    }
}
