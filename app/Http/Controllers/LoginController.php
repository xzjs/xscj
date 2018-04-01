<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $object = null;
            switch ($request['type']) {
                case 0:
                    $object = Student::find($request->id);
                    break;
                case 1:
                    $object = Teacher::find($request->id);
                    break;
                case 2:
                    $object = Admin::find($request->id);
                    break;
                default:
                    $result['status'] = false;
                    $result['message'] = "登录类型错误";
            }
            if ($object->pwd == md5($request['pwd'])) {
                $result['status'] = true;
                $result['id'] = $object->id;
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
            $object = null;
            switch ($request->type) {
                case 0:
                    $object = Student::find($id);
                    break;
                case 1:
                    $object = Teacher::find($id);
                    break;
                case 2:
                    $object = Admin::find($id);
            }
            if (md5($request->old_pwd) == $object->pwd) {
                $object->pwd = md5($request->new_pwd);
                $object->save();
            } else {
                $result = array(
                    "status" => false,
                    "message" => "原密码错误"
                );
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
