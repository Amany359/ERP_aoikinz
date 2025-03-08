<?php

namespace App\Services;

use App\Models\Engineer;

class EngineerService
{
    public function createEngineer(array $data)
    {
        return Engineer::create($data);
    }

    public function updateEngineer(Engineer $engineer, array $data)
    {
        $engineer->update($data);
        return $engineer;
    }

    public function deleteEngineer(Engineer $engineer)
    {
        return $engineer->delete();
    }

    public function getAllEngineers()
    {
        return Engineer::all();
    }

    public function getEngineerById($id)
    {
        return Engineer::findOrFail($id);
    }
}
