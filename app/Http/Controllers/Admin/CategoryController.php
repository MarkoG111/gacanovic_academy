<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Services\Helper;
use App\Http\Services\ImageHelper;
use App\Http\Services\Logs;
use App\Models\Category;
use Illuminate\Http\Request;
use PDOException;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new Category();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->categoryModel->getCategoriesForAdmin();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AddCategoryRequest $AddCatRequest)
    {
        $name = $request->input('categoryName');

        $fileName = time() . '-category-' . $request->categoryImage->getClientOriginalName();
        $request->categoryImage->move(public_path('img/categories'), $fileName);

        try {
            $this->categoryModel->addCategory($name, $fileName);
            Logs::loggingSuccess('Admin added a new category.');
            return redirect()->back()->with('success', 'Successfully added new category.');
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[CategoryController::class, "store"]');
            return Helper::returnGenericError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.categories_edit', ['category' => $this->categoryModel->getSingleCategory($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $categoryName = $request->input('categoryName');
        $categoryImage = $request->file('categoryImage');
        $updatedAt = date('Y-m-d H-i-s', time());

        if ($categoryImage != null) {
            $fileName = time() . '-category-' . $request->categoryImage->getClientOriginalName();
            $request->categoryImage->move(public_path('img/categories'), $fileName);

            try {
                $this->categoryModel->updateCategoryWithImage($id, $categoryName, $fileName, $updatedAt);
                Logs::loggingSuccess('Admin updated category.');
                return redirect()->route('categories.edit', ['category' => $id])->with('success', 'Successfully updated category.');
            } catch (PDOException $ex) {
                Logs::logging($ex->getMessage(), '[CategoryController::class, "update"]');
                return Helper::returnGenericError();
            }
        } else {
            try {
                $this->categoryModel->updateCategoryWithoutImage($id, $categoryName, $updatedAt);
                Logs::loggingSuccess('Admin updated category.');
                return redirect()->route('categories.edit', ['category' => $id])->with('success', 'Successfully updated category.');
            } catch (PDOException $ex) {
                Logs::logging($ex->getMessage(), '[CategoryController::class, "update"]');
                return Helper::returnGenericError();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->categoryModel->deleteCategory($id);
            Logs::loggingSuccess('Admin just deleted category.');
            return response([], 204);
        } catch (PDOException $ex) {
            Logs::logging($ex->getMessage(), '[CategoryController::class, "destroy"]');
            return Helper::returnGenericErrorAjax();
        }
    }
}
