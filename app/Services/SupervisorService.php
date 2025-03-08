<?php

namespace App\Services;

use App\Models\Supervisor;

class SupervisorService
{
    public function getAll()
    {
        return Supervisor::all();
    }

    public function getById($id) // ✅ الحل هنا
    {
        return Supervisor::find($id);
    }

    public function store(array $data)
    {
        return Supervisor::create($data);
    }

    public function show(Supervisor $supervisor)
    {
        return $supervisor;
    }

    public function update(Supervisor $supervisor, array $data)
    {
        $supervisor->update($data);
        return $supervisor;
    }

    public function delete(Supervisor $supervisor)
    {
        $supervisor->delete();
        return true;
    }

    /**
     * جلب المعاملات الخاصة بمشرف محدد باستخدام العلاقة.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getTransactions($id)
    {
        $supervisor = Supervisor::with('transactions')->find($id);
        if (!$supervisor) {
            return null;
        }
        return $supervisor->transactions;
    }

    /**
     * جلب التقارير الخاصة بمشرف محدد باستخدام العلاقة.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getReports($id)
    {
        $supervisor = Supervisor::with('reports')->find($id);
        if (!$supervisor) {
            return null;
        }
        return $supervisor->reports;

    }
}
