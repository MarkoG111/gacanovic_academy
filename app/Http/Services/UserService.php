<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function updateUser(Request $request, $id)
    {
        $user = new User();

        $obj = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'updated_at' => date('Y-m-d H-i-s', time())
        ];

        if ($request->has('role')) {
            $obj['id_role'] = $request->input('role');
        }

        $active = $request->input('active');
        if ($active != null) {
            $obj['active'] = $active;
        } else {
            $obj['active'] = 0;
        }

        $password = $request->input('password');
        if ($password != null) {
            $obj['password'] = md5($password);
        }

        $user->updateUser($obj, $id);
    }
}
