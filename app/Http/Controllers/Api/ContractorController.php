<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contractor\StoreContractorrRequest;
use App\Http\Requests\Contractor\UpdateContractorrRequest;
use App\Models\Contractor;
use App\Services\ContractorService;
use Illuminate\Http\JsonResponse;

class ContractorController extends Controller
{
    protected $contractorService;

    public function __construct(ContractorService $contractorService)
    {
        $this->contractorService = $contractorService;
    }

    public function index(): JsonResponse
    {
        $contractors = $this->contractorService->getAllContractors();
        return response()->json(['success' => true, 'contractors' => $contractors]);
    }

    public function store(StoreContractorrRequest $request): JsonResponse
    {
        $contractor = $this->contractorService->createContractor($request->validated());
        return response()->json(['success' => true, 'contractor' => $contractor], 201);
    }

    public function update(UpdateContractorrRequest $request, Contractor $contractor): JsonResponse
    {
        $contractor = $this->contractorService->updateContractor($contractor, $request->validated());
        return response()->json(['success' => true, 'contractor' => $contractor]);
    }

    public function destroy(Contractor $contractor): JsonResponse
    {
        $this->contractorService->deleteContractor($contractor);
        return response()->json(['success' => true, 'message' => 'Contractor deleted successfully']);
    }
}


