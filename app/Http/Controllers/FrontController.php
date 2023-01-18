<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterCoursesRequest;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Order;
use App\Models\Category;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $data;
    protected $modelTopics;
    protected $modelCourses;
    protected $modelCategories;
    protected $modelLearnings;
    protected $modelLessons;
    protected $modelUser;
    protected $modelInstructor;

    public function __construct()
    {
        $this->modelTopics = new Topic();
        $this->modelCourses = new Course();
        $this->modelCategories = new Category();
        $this->modelLearnings = new Order();
        $this->modelLessons = new Lesson();
        $this->modelUser = new User();
        $this->modelInstructor = new Instructor();

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

    public function checkoutPage()
    {
        return view('pages.user.checkout', $this->data);
    }

    public function learningsPage()
    {
        $idUser = session()->get('user')->id_user;

        $learnings = ['myLearnings' => $this->modelLearnings->listLearningsForUser($idUser)];
        foreach ($learnings as $learning) {
            $courses = [];
            foreach ($learning as $l) {
                $courses[] = $l->id_course;
            }
        }

        return view('pages.user.learnings', ['myLearnings' => $this->modelLearnings->listLearningsForUser($idUser), 'categories' => $this->modelCategories->getFeaturedCategories(3), 'lessons' => $this->modelLessons->getAllLessonsForCourses($courses)]);
    }

    public function instructorPage()
    {
        $idUser = session()->get('user')->id_user;

        $isInstructor = $this->modelUser->getSingleUser($idUser)->is_instructor;
        if ($isInstructor === 1) {
            return view('pages.admin.courses', ['categories' => $this->modelCategories->getAllCateogries(), 'topics' => $this->modelTopics->getAllTopics(), 'lessons' => $this->modelLessons->getAllLessons()]);
        } else {
            return view('pages.instructor.instructor', ['user' => $this->modelUser->getSingleUser($idUser), 'answers' => $this->modelInstructor->getPollAnswers(), 'categories' => $this->modelCategories->getAllCateogries()]);
        }

    }

    public function ordersPage()
    {
        return view('pages.user.orders', ['ordersAdmin' => $this->modelLearnings->listOrdersAdmin(), 'categories' => $this->modelCategories->getFeaturedCategories(3)]);
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

        if (session()->has('user')) {
            $currentAuthor = session()->get('user')->username;
            $this->data['courses'] = $this->modelCourses->filter($search, $categoriesChb, $topicChb, $sort, $showing, $currentAuthor);

            $idUser = session()->get('user')->id_user;
            $this->data['myLearnings'] = $this->modelLearnings->listLearningsForUser($idUser);
        } else {
            $currentAuthor = '';
            $this->data['courses'] = $this->modelCourses->filter($search, $categoriesChb, $topicChb, $sort, $showing, $currentAuthor);
        }

        $this->data['topics'] = $this->modelTopics->getAllTopics();

        return view('pages.user.courses', $this->data);
    }

    public function singleCoursePage($id)
    {
        if (session()->has('user')) {
            $idUser = session()->get('user')->id_user;
            $this->data['myLearnings'] = $this->modelLearnings->listLearningsForUser($idUser);
        }

        $course = $this->modelCourses->getSingleCourse($id);
        $this->data['course'] = $course;

        return view('pages.user.singe_course', $this->data);
    }
}
