<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\Helper;
use App\Http\Services\Logs;
use App\Http\Services\UserService;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PDOException;

class UserController extends Controller
{
    private $userModel;
    private $roleModel;
    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userModel->getUsersForAdmin();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.users', ['roles' => $this->roleModel->getAllRoles()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $created_at = date('Y-m-d H-i-s', time());
        $obj = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => md5($request->input('password')),
            'active' => 0,
            'id_role' => $request->input('role'),
            'created_at' => $created_at,
            'updated_at' => $created_at
        ];

        try {
            $this->userModel->insert($obj);
            Logs::loggingSuccess('Admin added a user');
            return response([], 201);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[UserController::class, "store"]');
            return Helper::returnGenericErrorAjax();
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
        return view('pages.admin.users_edit', ['user' => $this->userModel->getSingleUser($id), 'roles' => $this->roleModel->getAllRoles()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $service = new UserService();
        try {
            $service->updateUser($request, $id);
            Logs::loggingSuccess('Admin just updated a user.');
            return redirect()->route('users.edit', ['user' => $id])->with('success', 'Successfully updated user.');
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[UserController::class, "update"]');
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
            $this->userModel->deleteUser($id);
            Logs::loggingSuccess('Admin deleted a user');
            return response([], 204);
        } catch (Exception $ex) {
            Logs::logging($ex->getMessage(), '[UserController::class, "destroy"]');
            return Helper::returnGenericErrorAjax();
        }
    }
}
