<?php

namespace App\Services;

use App\Charts\PieChartUserDoc;
use App\Models\Administrator;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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

    public static function getIsAdmin(int $id): bool
    {
        return Administrator::query()
            ->where('user_id', $id)
            ->exists();
    }

    public function getAdminData(): Collection
    {

        $totalUsers = User::query()->count();

        $totalDocuments = Document::query()->count();

        $chart_options = [
            'chart_title' => 'Users created by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
        ];
        $colors = ['#FF5733', '#33FF57', '#5733FF', '#FF3357', '#57FF33', '#3357FF'];

        $chartAdmin1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Actions in the last month',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\History',
            'group_by_field' => 'type',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];
        $chartAdmin2 = new LaravelChart($chart_options);

        // Retrieve data from the database
        $users = User::with('departments')->get();

        $groupedUsers = $users->groupBy(function ($user) {
            return $user->departments->pluck('name')->implode(',');
        });

        $chartData = $groupedUsers->map(function ($users, $departmentNames) {
            return [
                'group' => $departmentNames, // Department names as a comma-separated string
                'value' => count($users), // Count of users in each department
            ];
        })->values();
        $chartAdmin3 = new PieChartUserDoc;
        $chartAdmin3->labels($chartData->pluck('group')->toArray());
        $chartAdmin3->dataset('Users by Department', 'bar', $chartData->pluck('value')->toArray())
            ->options([
                'backgroundColor' => $colors
            ]);

        $documents = Document::with('categories')->get();
        $groupedDocuments = $documents->groupBy(function ($document) {
            return $document->categories->pluck('value')->implode(',');
        });

        $chartData1 = $groupedDocuments->map(function ($documents, $categories) {
            return [
                'group' => $categories,
                'value' => count($documents),
            ];
        });

        $chartAdmin4 = new PieChartUserDoc();
        $chartAdmin4->labels($chartData1->pluck('group')->toArray());
        $chartAdmin4->dataset('Documents by Category', 'pie', $chartData1->pluck('value')->toArray())
            ->options([
                'backgroundColor' => $colors
            ]);

        return collect(['totalUsers' => $totalUsers,
            'totalDocuments' => $totalDocuments,
            'chartAdmin1' => $chartAdmin1,
            'chartAdmin2' => $chartAdmin2,
            'chartAdmin3' => $chartAdmin3,
            'chartAdmin4' => $chartAdmin4,]);
    }

    public function getUserData(): Collection
    {
        $user = Auth::user();
        $totalUserDoc = $user->documents->count();
        $colors = ['#FF5733', '#33FF57', '#5733FF', '#FF3357', '#57FF33', '#3357FF'];

        $user = User::with(['documents.categories'])
            ->whereHas('documents', function ($query) {
                $query->where('documents.user_id', Auth::user()->id);
            })
            ->first();

        if ($user) {
            $chartData1 = $user->documents->flatMap(function ($document) {
                return $document->categories;
            })->groupBy('id')->map(function ($group) {
                return [
                    'group' => $group->first()->value,
                    'value' => $group->count(),
                ];
            });

            $chart = new PieChartUserDoc();
            $chart->labels($chartData1->pluck('group')->toArray());
            $chart->dataset("Document Categories Of User", 'pie', $chartData1->pluck('value')->toArray())
                ->options([
                    'backgroundColor' => $colors,
                ]);
        }
        return collect(['totalUserDoc' => $totalUserDoc,
            'categoriesOfUser' => $chart,
        ]);
    }
}
