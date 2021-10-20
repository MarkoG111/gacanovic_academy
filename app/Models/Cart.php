<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function insert($idUser, $idCourse)
    {
        DB::table('cart')
            ->insert([
                'id_user' => $idUser,
                'id_course' => $idCourse,
                'order_date' => date('Y-m-d H-i-s', time())
            ]);
    }

    // orders for every specific user
    public function listOrdersForUser($idUser)
    {
        return DB::table('cart AS c')
            ->join('user AS u', 'u.id_user', '=', 'c.id_user')
            ->join('course AS cou', 'cou.id_course', '=', 'c.id_course')
            ->where('u.id_user', $idUser)
            ->get();
    }

    // all orders, for Admin
    public function listOrdersAdmin()
    {
        return DB::table('cart AS c')
            ->join('user AS u', 'u.id_user', '=', 'c.id_user')
            ->join('course AS cou', 'cou.id_course', '=', 'c.id_course')
            ->orderBy('order_date', 'DESC')
            ->paginate(4);
    }
}
