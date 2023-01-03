<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Http\Services\Helper;
use App\Http\Services\Logs;
use Exception;
use Illuminate\Http\Request;
use PDOException;

class AuthController extends FrontController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function doRegister(RegistrationRequest $request)
    {
        $created_at = date('Y-m-d H-i-s', time());
        $obj = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => md5($request->input('password')),
            'active' => 0,
            'id_role' => 2,
            'created_at' => $created_at,
            'updated_at' => $created_at
        ];

        try {
            $this->model->insert($obj);

            Logs::loggingSuccess('User: ' . $obj['username'] . ', Action: Register');
            return response([], 201);
        } catch (Exception $ex) {
            Logs::logging($ex->getMessage(), '[AuthController::class, "doRegister"]');
            return Helper::returnGenericErrorAjax();
        }
    }

    public function doLogin(Request $request, LoginRequest $loginRequest)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {
            $user = $this->model->getUsernameAndPassword($username, $password);

            if ($user) {
                $request->session()->put('user', $user);

                $time = Helper::getTime();
                $this->model->updateActivityLogin(session()->get('user')->id_user, 1, $time);

                Logs::loggingSuccess('User: ' . $user->username . ', Action: Login');

                if (session()->get('user')->id_user == 1) {
                    return redirect()->route('logs');
                }

                return redirect('/');
            } else {
                return redirect()->route('login')->with('error', 'Wrong password or account is inactive.');
            }
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[AuthController::class, "doLogin"]');
            return Helper::returnGenericError();
        }
    }

    public function doLogout(Request $request)
    {
        if ($request->session()->has('user')) {
            $time = Helper::getTime();
            try {
                $this->model->updateActivityLogout(session()->get('user')->id_user, 0, $time);

                Logs::loggingSuccess('User: ' . session('user')->username . ', Action: Logout');

                $request->session()->forget('user');

                return redirect('/');
            } catch (PDOException $ex) {
                Logs::logging($ex->getMessage(), '[AuthController::class, "doLogout"]');
                return Helper::returnGenericError();
            }
        }
    }
}
