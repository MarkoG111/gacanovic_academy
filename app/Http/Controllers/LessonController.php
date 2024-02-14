<?php

namespace App\Http\Controllers;

use App\Http\Services\Helper;
use App\Models\Lesson;
use App\Http\Services\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Exception;
use PDOException;


class LessonController extends Controller
{
    private $lessonModel;

    public function __construct()
    {
        $this->lessonModel = new Lesson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $this->lessonModel->deleteLesson($id);
            Logs::loggingSuccess('Admin deleted a lesson');

            return response([], 204);
        } catch (\Exception $ex) {
            Logs::logging($ex->getMessage(), '[LessonController::class, "destroy"]');

            return Helper::returnGenericErrorAjax();
        }
    }
}
