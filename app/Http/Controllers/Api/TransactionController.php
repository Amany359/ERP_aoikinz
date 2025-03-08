<?php

namespace App\Http\Controllers\Api; // ✅ إضافة النيم سبيس الصحيح

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Services\TransactionService;
use App\Helpers\Helpers;
use App\Models\Transaction;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = $this->transactionService->getAllTransactions();
        return Helpers::jsonResponse(true, $transactions, 'تم جلب جميع المعاملات بنجاح');
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = $this->transactionService->createTransaction($request->validated());
        return Helpers::jsonResponse(true, $transaction, 'تم إنشاء المعاملة بنجاح', 201);
    }

    public function show($id)
    {
        $transaction = $this->transactionService->getTransactionById($id);
        return Helpers::jsonResponse(true, $transaction, 'تم جلب بيانات المعاملة بنجاح');
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $updatedTransaction = $this->transactionService->updateTransaction($transaction, $request->validated());
        return Helpers::jsonResponse(true, $updatedTransaction, 'تم تحديث المعاملة بنجاح');
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->deleteTransaction($transaction);
        return Helpers::jsonResponse(true, null, 'تم حذف المعاملة بنجاح', 204);
    }
}
