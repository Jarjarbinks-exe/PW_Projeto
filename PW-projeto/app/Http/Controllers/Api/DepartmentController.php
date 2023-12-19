<?php

namespace App\Http\Controllers\Api;

use App\Dto\DepartmentDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DepartmentResourceCollection;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('departments:list')) {
            abort(403);
        }

        return new DepartmentResourceCollection(Department::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->only(['name']);
        if (!Auth::user()->tokenCan('departments:create')) {
            abort(403);
        }

        // Create the user
        if (Department::create(['name' => $requestData['name']
        ])) {
            return response()->json(['message' => 'Department created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create department'], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($department)
    {
        if (!auth()->user()->tokenCan('departments:show')) {
            abort('403');
        }

        try {
            $department = Department::findOrFail($department);
            return new DepartmentResource($department);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $department)
    {
        if (!Auth::user()->tokenCan('departments:update')) {
            abort(403);
        }
        try {
            $department = Department::findOrFail($department);
            $departmentDTO = new DepartmentDTO(
                $request['name'],
            );
            $department->update($departmentDTO->toArray());
            return new DepartmentResource($department);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department)
    {
        if (!Auth::user()->tokenCan('departments:destroy')) {
            abort(403);
        }
        try {
            $department = Department::findOrFail($department);
            Department::destroy($department->id);
            return response()->json(['message' => 'Foi encontrado e destruido o User: ' . $department->id]);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }

    }
}
