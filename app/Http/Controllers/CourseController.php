<?php

namespace App\Http\Controllers;

use App\Course;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CourseController extends Controller
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
            $query = Input::get('teacher_id');
            if (isset($query)) {
                $result['data'] = Course::where('teacher_id', $query)->get();
            } else {
                $courses = Course::with('teacher:id,name')->get();
                $result['data'] = $courses;
            }
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
            $course = new Course();
            $course->name = $request->name;
            $course->teacher_id = $request->teacher_id;
            $course->save();
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
        $result['status'] = true;
        try {
            $course = Course::find($id);
            $course->name = $request->name;
            $course->teacher_id = $request->teacher_id;
            $course->save();
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
            Grade::where('course_id', $id)->delete();
            Course::destroy($id);
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
