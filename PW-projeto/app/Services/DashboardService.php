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

    # TODO Isto está feio, definir um GATE para usar o modelo Admin
    public function getIsAdmin(int $id): bool {
         return Administrator::query()
             ->where('user_id', $id)
             ->exists();
    }

    # TODO RETORNAR OS DADOS DO ADMIN
    public function getAdminData()
    {
        return Collection::class;
    }

    public function getUserData(): Collection
    {
        return collect();
    }
}
