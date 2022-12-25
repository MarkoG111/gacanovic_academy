<?php

namespace App\Http\Controllers;

use App\Http\Services\Logs;
use App\Models\Course;
use PDOException;

class CartController extends FrontController
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = new Course();
    }

    public function getCoursesForCart()
    {
        try {
            $courses = $this->courseModel->getAllCourses();
            return response()->json($courses);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[CartController::class, "getCoursesForCart"]');
        }
    }
}
