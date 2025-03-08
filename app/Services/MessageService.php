<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    /**
     * Sends a message from the sender to the receiver.
     *
     * @param int    $senderId
     * @param int    $receiverId
     * @param string $messageContent
     * @return \App\Models\Message
     */
    public function sendMessage(int $senderId, int $receiverId, string $messageContent): Message
    {
        // قم بتقليم محتوى الرسالة للتأكد من عدم وجود مسافات زائدة
        $content = trim($messageContent);

        return Message::create([
            'sender_id'   => $senderId,
            'receiver_id' => $receiverId,
            'message'     => $content,
        ]);
    }

    /**
     * Retrieves all messages related to the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserMessages()
    {
        $user = Auth::user();

        return Message::where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                          ->orWhere('receiver_id', $user->id);
                })
                ->orderBy('created_at', 'asc')
                ->get();
    }
}
