<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['status'] = true;
        try {
            $result['data'] = Student::select('id', 'name')->get();
        } catch (\Exception $exception) {
            $result = array(
                "status" => false,
                "message" => $exception->getMessage()
            );
        } finally {
            return response()->json($result);
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result['status'] = true;
        try {
            $student = new Student;
            $student->name = $request->name;
            $student->clas_id=$request->clas_id;
            $student->pwd = md5('student');
            $student->save();
        } catch (\Exception $exception) {
            $result = array(
                "status" => false,
                "message" => $exception->getMessage()
            );
        } finally {
            return response()->json($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result['status'] = true;
        try {
            Student::destroy($id);
        } catch (\Exception $exception) {
            $result = array(
                "status" => false,
                "message" => $exception->getMessage()
            );
        } finally {
            return response()->json($result);
        }
    }
}