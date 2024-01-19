<?php

namespace App\Http\Controllers;

use App\Charts\PieChartUserDoc;
use App\Models\Document;
use App\Models\User;
use App\Services\DashboardService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DashboardService $service)
    {


        $data = $service->getDashboardData();
        return view(
            'dashboard',
            [
                'data' => $data,
            ]
        );
    }
}
