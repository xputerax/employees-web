<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::take(100)->get();

        return [
            'success' => true,
            'data' => $departments,
            'data_count' => $departments->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department_info = $request->only(['dept_no', 'dept_name']);
        $department = Department::create($department_info);

        return [
            'success' => true,
            'department' => $department
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return [
            'success' => true,
            'department' => $department,
            'managers' => [
                'data_count' => $department->managers()->count(),
                'data' => $department->managers
            ],
            'num_employees' => $department->employees()->count(),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department_info = $request->only([
            'department.dept_name'
        ])['department'];

        $success = $department->update($department_info);

        return [
            'success' => $success,
            'department' => $department
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    public function managers(Department $department)
    {
        return [
            'success' => true,
            'managers' => [
                'total' => $department->managers()->count(),
                'data' => $department->managers()->take(10)->get()
            ]
        ];
    }

    public function employees(Department $department)
    {
        return [
            'success' => true,
            'employees' => [
                'total' => $department->employees()->count(),
                'data' => $department->employees()->take(10)->get()
            ]
        ];
    }
}
