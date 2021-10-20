<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseTopic extends Model
{
    public function insertCourseTopic($course, $topic)
    {
        DB::table('course_topic')
            ->insert([
                'id_course' => $course,
                'id_topic' => $topic
            ]);
    }

    public function deleteCourse($id)
    {
        DB::table('course_topic')
            ->where(['id_course' => $id])
            ->delete();
    }
}
