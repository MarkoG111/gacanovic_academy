<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wish extends Model
{
    use HasFactory;

    public function addWish($idUser, $idCourse)
    {
        DB::table('wish')
            ->insert([
                'id_user' => $idUser,
                'id_course' => $idCourse,
                'created_at' => date('Y-m-d H-i-s', time())
            ]);
    }

    public function checkIfAlereadyExists($idUser, $idCourse)
    {
        return DB::table('wish')
            ->where(['id_user' => $idUser, 'id_course' => $idCourse])
            ->exists();
    }

    public function numberOfWishes($idUser)
    {
        return DB::table('wish')
            ->where(['id_user' => $idUser])
            ->count();
    }

    public function getAllWishesForOneUser($idUser)
    {
        return DB::table('course')
            ->join('wish', 'course.id_course', '=', 'wish.id_course')
            ->join('user', 'wish.id_user', '=', 'user.id_user')
            ->where(['user.id_user' => $idUser])
            ->get();
    }

    public function deleteWish($idWish)
    {
        DB::table('wish')->where(['id_wish' => $idWish])->delete();
    }

    public function deleteWishWithCourse($idCourse)
    {
        DB::table('wish')->where(['id_course' => $idCourse])->delete();
    }

    public function deleteWishWithUser($idUser)
    {
        DB::table('wish')->where(['id_user' => $idUser])->delete();
    }
}
