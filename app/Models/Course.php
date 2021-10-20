<?php

namespace App\Models;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    public function insertCourse($courseName, $price, $totalHours, $image_small, $image_big, $id_category)
    {
        return DB::table('course')
            ->insertGetId([
                'course_name' => $courseName,
                'price' => $price,
                'total_hours' => $totalHours,
                'image_small' => $image_small,
                'image_big' => $image_big,
                'id_category' => $id_category,
                'created_at' => date('Y-m-d H-i-s', time()),
                'updated_at' => date('Y-m-d H-i-s', time())
            ]);
    }

    public function getAllCourses()
    {
        return DB::table('course AS c')
            ->join('category AS cat', 'c.id_category', '=', 'cat.id_category')
            ->get();
    }

    public function getCoursesForAdmin()
    {
        return DB::table('course')->paginate(6);
    }

    public function filter($search, $categories, $topic, $sort, $showing)
    {
        $query = DB::table('course');

        if ($search) {
            $query = $query->where('course_name', 'like', '%' . $search . '%');
        }
        $query = $query->join('category', 'course.id_category', '=', 'category.id_category');

        if ($categories) {
            $query = $query->whereIn('category.id_category', $categories);
        }

        if ($topic) {
            $query = $query->join('course_topic', 'course.id_course', '=', 'course_topic.id_course')
                ->join('topic', 'course_topic.id_topic', '=', 'topic.id_topic')
                ->whereIn('topic.id_topic', $topic);
        }

        switch ($sort) {
            case 'date':
                $query = $query->latest('course.created_at');
                break;
            case 'priceAsc':
                $query = $query->orderBy('course.price', 'ASC');
                break;
            case 'priceDesc':
                $query = $query->orderBy('course.price', 'DESC');
                break;
        }

        $query = $query->paginate($showing);

        return $query;
    }

    public function getSingleCourseTopics($id)
    {
        return DB::table('course')
            ->join('course_topic', 'course.id_course', '=', 'course_topic.id_course')
            ->join('topic', 'course_topic.id_topic', '=', 'topic.id_topic')
            ->select('topic.*')
            ->where('course.id_course', '=', $id)
            ->get();
    }

    public function getSingleCourse($idCourse)
    {
        $courseSingle =  DB::table('course')
            ->join('category', 'category.id_category', '=', 'course.id_category')
            ->where('course.id_course', $idCourse)
            ->first();

        $courseSingle->topics = $this->getSingleCourseTopics($idCourse);

        return $courseSingle;
    }

    public function deleteCourse($id)
    {
        DB::table('course')
            ->where(['id_course' => $id])
            ->delete();
    }

    public function updateCourseWithoutImage($id, $name, $price, $hours, $category, $updatedAt)
    {
        return DB::table('course')
            ->where('id_course', $id)
            ->update([
                'course_name' => $name,
                'price' => $price,
                'total_hours' => $hours,
                'id_category' => $category,
                'updated_at' => $updatedAt
            ]);
    }

    public function updateCourseWithImage($id, $name, $price, $hours, $smallImage, $bigImage, $category, $updatedAt)
    {
        return DB::table('course')
        ->where('id_course', $id)
            ->update([
                'course_name' => $name,
                'price' => $price,
                'total_hours' => $hours,
                'image_small' => $smallImage,
                'image_big' => $bigImage,
                'id_category' => $category,
                'updated_at' => $updatedAt
            ]);
    }
}
