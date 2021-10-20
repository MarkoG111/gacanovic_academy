<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Services\Helper;
use App\Http\Services\Logs;
use App\Mail\ContactMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends FrontController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function store(ContactRequest $request)
    {
        $obj = [
            'subject' => $request->input('subject'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'date' => date('Y-m-d H-i-s', time())
        ];

        try {
            Mail::to('test.test@gmail.com')->send(new ContactMail($obj));

            $this->model->storeContactEmail($obj);

            Logs::loggingSuccess('Successfully stored message');
            return response(['success' => 'Your message has been sent successfully!'], 201);
        } catch (Exception $ex) {
            Logs::logging($ex->getMessage(), 'Error.');
            return Helper::returnGenericErrorAjax();
        }
    }
}
