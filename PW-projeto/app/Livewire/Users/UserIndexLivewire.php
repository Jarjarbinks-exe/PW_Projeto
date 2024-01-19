<?php


namespace app\Livewire\Users;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserIndexLivewire extends Component
{
    public $department = '';
    public $search = '';

    public $userId = '';
    public $confirmed = false;

    public $selectedUsers = [];


    public function render()
    {
        $users = User::query();

        if ($this->department != '') {
            $users->whereHas('departments', function ($query) {
                $query->where('department_id', $this->department);
            });
        }

        if ($this->search != '') {
            $users->where(function (Builder $query) {
                $query->where('username', 'like', '%' . $this->search . '%');
            });
        }

        $users = $users->get();

        return view(
            'livewire.users.user-index-livewire',
            [
                'users' => $users
            ]
        )->extends('layouts.autenticado')->section('main-content');
    }

    function deleteEmployee(int $id)
    {
        if ($this->employeeId == $id) {
            $service = new UserService();
            $service->deleteEmployee(User::find($id));
            $this->userId = '';

        } else {
            $this->userId = $id;
        }
    }

    public function deleteSelected()
    {
        $uuids = array_keys(collect($this->selectedEmployees)
            ->filter(function ($element, $uuid) {
                return $element == true;
            })
            ->toArray());


        User::whereIn('uuid', $uuids,)
            ->delete();

    }
}
