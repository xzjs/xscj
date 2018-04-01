<?php

namespace App\Http\Controllers;

use App\Course;
use App\Grade;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
            $result['data'] = Teacher::select('id', 'name')->get();
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
        $result = array();
        try {
            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->pwd = md5('teacher');
            $teacher->save();
            $result['status'] = true;
            $result['id'] = $teacher->id;
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
        $result['status'] = true;
        try {
            $result['data'] = Teacher::find($id);
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
        $result['status'] = true;
        try {
            $teacher = Teacher::find($id);
            $teacher->name = $request->name;
            $teacher->save();
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result['status'] = true;
        try {
            $course_ids = Course::where('teacher_id', $id)->get(['id'])->toArray();
            foreach ($course_ids as $course_id) {
                Grade::where('course_id', $course_id)->delete();
            }
            Course::destroy($course_ids);
            Teacher::destroy($id);
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
