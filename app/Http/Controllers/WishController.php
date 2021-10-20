<?php

namespace App\Http\Controllers;

use App\Http\Services\Logs;
use App\Models\Wish;
use Illuminate\Http\Request;
use PDOException;

class WishController extends Controller
{
    private $modelWish;

    public function __construct()
    {
        $this->modelWish = new Wish();
    }

    public function addNewWish(Request $request)
    {
        $idCourse = $request->input('idCourse');

        if (!session()->has('user')) {
            return response([], 401); //  unauthorized
        }

        $idUser = session('user')->id_user;

        try {
            $ifExists = $this->modelWish->checkIfAlereadyExists($idUser, $idCourse);
            if ($ifExists) {
                return response('Course is already in your wishlist', 200);
            }

            $this->modelWish->addWish($idUser, $idCourse);
            Logs::loggingSuccess('User: ' . session('user')->username . ', Added Wish');
            return response('Successfully added course to wishlist', 201);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[WishController::class, "addNewWish"]');
            return response([], 500);
        }
    }

    public function numberOfWishes()
    {
        $idUser = session('user')->id_user ?? 0;
        try {
            $info = $this->modelWish->numberOfWishes($idUser);
            return response($info);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[WishController::class, "numberOfWishes"]');
            return response([], 500);
        }
    }

    public function getAllWishesForOneUser()
    {
        $idUser = session('user')->id_user;

        try {
            $info = $this->modelWish->getAllWishesForOneUser($idUser);
            return response($info);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[WishController::class, "getAllWishesForOneUser"]');
            return response([], 500);
        }
    }

    public function deleteWish(Request $request)
    {
        $idWish = $request->input('idWish');

        try {
            $this->modelWish->deleteWish($idWish);
            Logs::loggingSuccess('User: ' . session('user')->username . ', Removed Wish');
            return response([], 204);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[WishController::class, "deleteWish"]');
            return response([], 500);
        }
    }
}
