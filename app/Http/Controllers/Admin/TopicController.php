<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUpdateTopicRequest;
use App\Http\Services\Helper;
use App\Http\Services\Logs;
use App\Models\Topic;
use Illuminate\Http\Request;
use PDOException;

class TopicController extends Controller
{
    private $topicModel;
    public function __construct()
    {
        $this->topicModel = new Topic();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->topicModel->getAdminTopics();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.topics');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AddUpdateTopicRequest $topicRequest)
    {
        $topicName = $request->input('topicName');

        try {
            $this->topicModel->addTopic($topicName);
            Logs::loggingSuccess('Admin added a new topic.');
            return redirect()->back()->with('success', 'Successfully added new topic.');
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[TopicController::class, "store"]');
            return Helper::returnGenericError();
        }
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
        return view('pages.admin.topics_edit', ['topic' => $this->topicModel->getSingleTopic($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddUpdateTopicRequest $request, $id)
    {
        $topic = $request->input('topicName');
        try {
            $this->topicModel->updateTopic($id, $topic);
            Logs::loggingSuccess('Admin updated topic.');
            return redirect()->route('topics.edit', ['topic' => $id])->with('success', 'Successfully updated topic');
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[TopicController::class, "update"]');
            return Helper::returnGenericError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->topicModel->deleteTopic($id);
            Logs::loggingSuccess('Admin deleted topic');
            return response([], 204);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[TopicController::class, "destroy"]');
            return Helper::returnGenericErrorAjax();
        }
    }
}
