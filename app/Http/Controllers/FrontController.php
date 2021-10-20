<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterCoursesRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $data;
    protected $modelTopics;
    protected $modelCourses;
    protected $modelCategories;
    protected $modelOrders;

    public function __construct()
    {
        $this->modelTopics = new Topic();
        $this->modelCourses = new Course();
        $this->modelCategories = new Category();
        $this->modelOrders = new Cart();

        $categories = $this->modelCategories->getFeaturedCategories(3);
        $this->data['categories'] = $categories;
    }

    public function homePage()
    {
        return view('pages.user.home', $this->data);
    }

    public function wishesPage()
    {
        return view('pages.user.wishes', $this->data);
    }

    public function contactPage()
    {
        return view('pages.user.contact', $this->data);
    }

    public function authorPage()
    {
        return view('pages.user.author', $this->data);
    }

    public function loginPage()
    {
        return view('pages.user.login', $this->data);
    }

    public function cartPage()
    {
        return view('pages.user.cart', $this->data);
    }

    public function ordersPage()
    {
        $idUser = session()->get('user')->id_user;

        return view('pages.user.orders', ['orders' => $this->modelOrders->listOrdersForUser($idUser), 'ordersAdmin' => $this->modelOrders->listOrdersAdmin(), 'categories' => $this->modelCategories->getFeaturedCategories(3)]);
    }

    public function coursesPage(FilterCoursesRequest $request)
    {
        $search = $request->input('search');
        $categoriesChb = $request->input('categories') ?? [];
        $sort = $request->input('sort') ?? 'date';
        $topicChb = $request->input('topic') ?? [];
        $showing = $request->input('showing') ?? 6;

        $this->data['search'] = $search;
        $this->data['categoriesChb'] = $categoriesChb;
        $this->data['sort'] = $sort;
        $this->data['topicChb'] = $topicChb;
        $this->data['showing'] = $showing;

        $this->data['courses'] = $this->modelCourses->filter($search, $categoriesChb, $topicChb, $sort, $showing);
        $this->data['topics'] = $this->modelTopics->getAllTopics();

        return view('pages.user.courses', $this->data);
    }

    public function singleCoursePage($id)
    {
        $course = $this->modelCourses->getSingleCourse($id);
        $this->data['course'] = $course;

        return view('pages.user.singe_course', $this->data);
    }
}
