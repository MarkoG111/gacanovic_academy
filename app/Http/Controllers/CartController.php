<?php

namespace App\Http\Controllers;

use App\Http\Services\Logs;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use PDOException;

class CartController extends FrontController
{
    private $courseModel;
    private $cartModel;
    public function __construct()
    {
        $this->courseModel = new Course();
        $this->cartModel = new Cart();
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

    public function insertInCart(Request $request)
    {
        $idUser = session()->get('user')->id_user;
        $idCourse = $request->input('id');

        if (session()->get('user')->id_role == 1) {
            return response([], 401); // admin can't add courses to cart
        }

        try {
            $course = $this->cartModel->insert($idUser, $idCourse);
            return response()->json($course);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[CartController::class, "insertInCart"]');
        }
    }

}
