<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    public function insert($obj)
    {
        DB::table('user')
            ->insert($obj);
    }

    public function getUsernameAndPassword($username, $password)
    {
        return DB::table('user')
            ->select('id_user', 'username', 'email', 'id_role')
            ->where([
                'username' => $username,
                'password' => md5($password)
            ])
            ->first();
    }

    public function updateActivityLogin($id_user, $active, $time)
    {
        return DB::table('user')
            ->where('id_user', $id_user)
            ->update([
                'active' => $active,
                'last_login' => $time
            ]);
    }

    public function updateActivityLogout($id_user, $active, $time)
    {
        return DB::table('user')
            ->where('id_user', $id_user)
            ->update([
                'active' => $active,
                'last_logout' => $time
            ]);
    }

    public function storeContactEmail($obj)
    {
        return DB::table('contact_mail')
            ->insert($obj);
    }

    public function getUsersForAdmin()
    {
        return DB::table('user')
            ->join('role', 'user.id_role', '=', 'role.id_role')
            ->paginate(6);
    }

    public function getSingleUser($id)
    {
        return DB::table('user')
            ->where('id_user', $id)
            ->first();
    }

    public function deleteUser($id)
    {
        DB::table('user')
            ->where('id_user', $id)
            ->delete();
    }

    public function updateUser($obj, $id)
    {
        DB::table('user')
            ->where('id_user', $id)
            ->update($obj);
    }
}
