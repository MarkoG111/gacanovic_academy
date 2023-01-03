<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CourseOrder extends Model
{
    use HasFactory;

    public function insertCourseOrder($course, $order)
    {
        DB::table('courses_orders')
            ->insert([
                'id_course' => $course,
                'id_course_order' => $order
            ]);
    }

    public function deleteCourseFromOrder($id)
    {
        DB::table('courses_orders')
            ->where(['id_course' => $id])
            ->delete();
    }
}
