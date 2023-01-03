<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;

    public function insertCourseLesson($lessonURL, $course)
    {
        DB::table('lesson')
            ->insert([
                'lesson' => $lessonURL,
                'id_course' => $course
            ]);
    }

    public function getAllLessons()
    {
        return DB::table('lesson')
            ->get();
    }

    public function getAllLessonsForCourse($id_course)
    {
        return DB::table('lesson AS l')
            ->join('course AS c', 'c.id_course', '=', 'l.id_course')
            ->where('l.id_course', '=', $id_course)
            ->get();
    }

    public function getAllLessonsForCourses($id_courses)
    {
        return DB::table('lesson AS l')
            ->join('course AS c', 'c.id_course', '=', 'l.id_course')
            ->whereIn('c.id_course', $id_courses)
            ->get();
    }

    public function deleteLesson($id_lesson)
    {
        DB::table('lesson')
            ->where('id_lesson', $id_lesson)
            ->delete();
    }

    public function deleteCourseLesson($id_course)
    {
        DB::table('lesson')
            ->where('id_course', $id_course)
            ->delete();
    }

}
