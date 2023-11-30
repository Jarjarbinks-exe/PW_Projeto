<?php

namespace App\Services;

use App\Models\Administrator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getDashboardData(): Collection
    {
        if ($this->getIsAdmin(Auth::user()->id)) {
            return $this->getAdminData();
        } else {
            return $this->getUserData();
        }
    }

    public static function getIsAdmin(int $id): bool {
         return Administrator::query()
             ->where('user_id', $id)
             ->exists();
    }

    # TODO RETORNAR OS DADOS DO ADMIN
    public function getAdminData(): Collection
    {
        return collect(['admin' => true, 'data' => 'Admin Dashboard Data']);
    }

    public function getUserData(): Collection
    {
        return collect(['admin' => false, 'data' => 'User Dashboard Data']);
    }

}
