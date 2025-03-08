<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engineer\StoreEngineerRequest;
use App\Http\Requests\Engineer\UpdateEngineerRequest;
use App\Services\EngineerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EngineerController extends Controller
{
    protected $engineerService;

    public function __construct(EngineerService $engineerService)
    {
        $this->engineerService = $engineerService;
    }

    public function index(): JsonResponse
    {
        $engineers = $this->engineerService->getAllEngineers();
        return response()->json(['success' => true, 'engineers' => $engineers]);
    }

    public function store(StoreEngineerRequest $request): JsonResponse
    {
        $engineer = $this->engineerService->createEngineer($request->validated());
        return response()->json(['success' => true, 'engineer' => $engineer], 201);
    }

    public function show($id): JsonResponse
    {
        $engineer = $this->engineerService->getEngineerById($id);
        return response()->json(['success' => true, 'engineer' => $engineer]);
    }

    public function update(UpdateEngineerRequest $request, $id): JsonResponse
    {
        $engineer = $this->engineerService->getEngineerById($id);
        $updatedEngineer = $this->engineerService->updateEngineer($engineer, $request->validated());
        return response()->json(['success' => true, 'engineer' => $updatedEngineer]);
    }

    public function destroy($id): JsonResponse
    {
        $engineer = $this->engineerService->getEngineerById($id);
        $this->engineerService->deleteEngineer($engineer);
        return response()->json(['success' => true, 'message' => 'Engineer deleted successfully']);
    }
}
