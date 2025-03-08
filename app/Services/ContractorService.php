<?php

namespace App\Services;

use App\Models\Contractor;

class ContractorService
{
    public function createContractor(array $data)
    {
        return Contractor::create($data);
    }

    public function updateContractor(Contractor $contractor, array $data)
    {
        $contractor->update($data);
        return $contractor;
    }

    public function deleteContractor(Contractor $contractor)
    {
        return $contractor->delete();
    }

    public function getAllContractors()
    {
        return Contractor::orderBy('created_at', 'desc')->get();
    }
}
