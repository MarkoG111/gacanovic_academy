<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Services\Helper;
use App\Http\Services\ImageHelper;
use App\Http\Services\Logs;

use App\Models\Category;
use App\Models\CourseOrder;
use App\Models\CourseTopic;
use App\Models\Lesson;
use App\Models\Topic;
use App\Models\Course;

use App\Models\User;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDOException;

class CourseController
{
    private $data;
    private $categories;
    private $topics;
    private $courses;
    private $courseTopics;
    private $lessons;
    private $courseOrder;
    private $wishes;
    private $users;

    public function __construct()
    {
        $this->categories = new Category();
        $this->topics = new Topic();
        $this->courses = new Course();
        $this->courseTopics = new CourseTopic();
        $this->lessons = new Lesson();
        $this->courseOrder = new CourseOrder();
        $this->wishes = new Wish();
        $this->users = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->courses->getCoursesForAdmin();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.courses', ['categories' => $this->categories->getAllCateogries(), 'topics' => $this->topics->getAllTopics(), 'lessons' => $this->lessons->getAllLessons()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AddCourseRequest $addCourseRequest)
    {
        $courseName = $request->input('courseName');
        $description = $request->input('description');
        $price = $request->input('coursePrice');
        $totalHours = $request->input('courseHours');

        $idUser = session()->get('user')->id_user;
        $user = $this->users->getSingleUser($idUser);
        $author = $user->username . ' - Admin';

        $imageSmall = $request->file('courseImage');
        $imageBig = ImageHelper::insertImage($imageSmall);

        $idCategory = $request->input('category');

        DB::beginTransaction();
        try {
            $idCourse = $this->courses->insertCourse($courseName, $description, $price, $totalHours, $author, $imageBig[0], $imageBig[1], $idCategory);

            if (is_array($request->input('lesson'))) {
                foreach ($request->input('lesson') as $lesson) {
                    $this->lessons->insertCourseLesson($lesson, $idCourse);
                }
            } else {
                $this->lessons->insertCourseLesson($request->input('lesson'), $idCourse);
            }


            foreach ($request->input('topicsChb') as $topic) {
                $this->courseTopics->insertCourseTopic($idCourse, $topic);
            }

            DB::commit();

            Logs::loggingSuccess('Admin just added a new course.');
            return redirect()->route('courses.create')->with('success', 'Course has been added.');
        } catch (PDOException $ex) {
            DB::rollBack ();
            Logs::logging($ex->getMessage(), '[CourseController::class, "store"]');
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
        $this->data['categories'] = $this->categories->getAllCateogries();
        $this->data['topics'] = $this->topics->getAllTopics();
        $this->data['lessonsEdit'] = $this->lessons->getAllLessonsForCourse($id);
        $this->data['course'] = $this->courses->getSingleCourse($id);
        return view('pages.admin.courses_edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $courseName = $request->input('courseName');
        $description = $request->input('description');
        $price = $request->input('coursePrice');
        $totalHours = $request->input('courseHours');
        $idCategory = $request->input('category');
        $updatedAt = date('Y-m-d H-i-s', time());
        $image = $request->file('courseImage');

        DB::beginTransaction();
        if ($image != null) {
            $newImage = ImageHelper::insertImage($image);
            try {
                $this->courseTopics->deleteCourse($id);
                $this->courses->updateCourseWithImage($id, $courseName, $description, $price, $totalHours, $newImage[0], $newImage[1], $idCategory, $updatedAt);

                // delete lessons of course
                $this->lessons->deleteCourseLesson($id);

                // insert lessons of course
                if (is_array($request->input('lesson'))) {
                    foreach ($request->input('lesson') as $lesson) {
                        $this->lessons->insertCourseLesson($lesson, $id);
                    }
                } else {
                    $this->lessons->insertCourseLesson($request->input('lesson'), $id);
                }

                foreach ($request->input('topicsChb') as $topic) {
                    $this->courseTopics->insertCourseTopic($id, $topic);
                }

                DB::commit();

                Logs::loggingSuccess('Admin just updated a course.');
                return redirect()->route('courses.edit', ['course' => $id])->with('success', 'Course has been updated.');
            } catch (PDOException $ex) {
                DB::rollBack();
                Logs::logging($ex->getMessage(), '[CourseController::class, "update"]');
                return Helper::returnGenericError();
            }
        } else {
            try {
                $this->courseTopics->deleteCourse($id);
                $this->courses->updateCourseWithoutImage($id, $courseName, $description, $price, $totalHours, $idCategory, $updatedAt);

                // delete lessons of course
                $this->lessons->deleteCourseLesson($id);

                // insert lessons of course
                if (is_array($request->input('lesson'))) {
                    foreach ($request->input('lesson') as $lesson) {
                        $this->lessons->insertCourseLesson($lesson, $id);
                    }
                } else {
                    $this->lessons->insertCourseLesson($request->input('lesson'), $id);
                }

                foreach ($request->input('topicsChb') as $topic) {
                    $this->courseTopics->insertCourseTopic($id, $topic);
                }

                DB::commit();

                Logs::loggingSuccess('Admin just updated a course.');

                return redirect()->route('courses.edit', ['course' => $id])->with('success', 'Course has been updated.');
            } catch (PDOException $ex) {
                DB::rollBack();
                Logs::logging($ex->getMessage(), '[CourseController::class, "update"]');
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
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->courseTopics->deleteCourse($id);
            $this->lessons->deleteCourseLesson($id);
            $this->courseOrder->deleteCourseFromOrder($id);
            $this->wishes->deleteCoursFromWish($id);
            $this->courses->deleteCourse($id);

            DB::commit();

            Logs::loggingSuccess('Admin just deleted a course.');
            return response([], 204);
        } catch (PDOException $ex) {
            DB::rollback();

            Logs::logging($ex->getMessage(), '[CourseController::class, "destroy"]');
            return Helper::returnGenericErrorAjax();
        }
    }
}
