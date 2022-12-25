<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public function listLearningsForUser($idUser)
    {
        return DB::table('orders AS o')
            ->join('user AS u', 'u.id_user', '=', 'o.id_user')
            ->join('courses_orders AS co', 'co.id_course_order', '=', 'o.id_course_order')
            ->join('course AS c', 'c.id_course', '=', 'co.id_course')
            ->where('u.id_user', $idUser)
            ->get();
    }

    public function listOrdersAdmin()
    {
        return DB::table('orders AS o')
            ->join('user AS u', 'u.id_user', '=', 'o.id_user')
            ->join('courses_orders AS co', 'co.id_course_order', '=', 'o.id_course_order')
            ->join('course AS c', 'c.id_course', '=', 'co.id_course')
            ->orderBy('o.created_at', 'DESC')
            ->paginate(4);
    }

    public function checkIfCourseAlreadyBought($idUser, $idsCourses)
    {
        return DB::table('orders AS o')
            ->join('user AS u', 'u.id_user', '=', 'o.id_user')
            ->join('courses_orders AS co', 'co.id_course_order', '=', 'o.id_course_order')
            ->join('course AS c', 'c.id_course', '=', 'co.id_course')
            ->where('u.id_user', $idUser)
            ->exists();
    }
}
