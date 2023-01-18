@extends(session()->get('user')->id_role == 2 ? 'layout.instructor' : 'layout.admin')

@php
    $arrayInputs = [
        [
            'label' => 'Course',
            'type' => 'text',
            'name' => 'courseName',
            'placeholder' => 'Enter course name',
            'value' => $course->course_name,
        ],
        [
            'label' => 'Price',
            'type' => 'number',
            'name' => 'coursePrice',
            'placeholder' => 'Enter course price',
            'value' => $course->price,
        ],
        [
            'label' => 'Hours',
            'type' => 'number',
            'name' => 'courseHours',
            'placeholder' => 'Enter total hours',
            'value' => $course->total_hours,
        ],
        [
            'label' => 'Course Image',
            'type' => 'file',
            'name' => 'courseImage',
            'folder' => 'courses/',
            'image' => $course->image_small,
        ],
        [
            'label' => 'Description',
            'type' => 'textarea',
            'name' => 'description',
            'placeholder' => 'Add description',
            'value' => $course->description,
        ],
    ];

    $lessonObject = new stdClass();
    if (!$lessonsEdit->count() == 0) {
        foreach ($lessonsEdit as $l) {
            $lesson[] = ['value' => $l->id_lesson, 'text' => $l->lesson];
        }
        $lessonObject->option = $lesson;
    }


    $lessonObject->type = 'text';
    $lessonObject->name = 'lesson[]';
    $lessonObject->placeholder = 'Enter URL for lesson';
    $lessonObject->label = 'Course Lessons';

    $arrayLessonsEdit = [$lessonObject];

    foreach ($categories as $c) {
        $cat[] = ['value' => $c->id_category, 'text' => $c->category_name];
    }
    $categoryObject = new stdClass();
    $categoryObject->option = $cat;
    $categoryObject->name = 'category';
    $categoryObject->label = 'Course categories';
    $categoryObject->selected = $course->id_category;

    $arrayDropdowns = [$categoryObject];

    foreach ($topics as $t) {
        $topicsChb[] = ['value' => $t->id_topic, 'text' => $t->topic_name];
    }

    foreach ($course->topics as $ct) {
        $selectedTopics[] = $ct->id_topic;
    }

    $topicObject = new stdClass();
    $topicObject->option = $topicsChb;
    $topicObject->name = 'topicsChb[]';
    $topicObject->label = 'Couse topics';
    $topicObject->selected = $selectedTopics;

    $arrayCheckboxes = [$topicObject];
@endphp

@section('content')
    @if (session()->get('user')->id_role == 1)
        @component('components.admin.form',
            [
                'headTitle' => 'Courses',
                'title' => 'Edit Course',
                'method' => 'PUT',
                'action' => 'courses.update',
                'arrayInputs' => $arrayInputs,
                'arrayLessonsEdit' => $arrayLessonsEdit,
                'arrayDropdowns' => $arrayDropdowns,
                'arrayCheckboxes' => $arrayCheckboxes,
                'id' => $course->id_course,
                'button' => '',
            ])
        @endcomponent
    @else
        @component('components.instructor.form',
            [
                'pageTitleInstructor' => 'Courses - Instructor',
                'formTitleInstructor' => 'Edit Course',
                'methodInstructor' => 'PUT',
                'actionInstructor' => 'instructorUpdateCourse',
                'arrayInputsInstructor' => $arrayInputs,
                'arrayLessonsEdit' => $arrayLessonsEdit,
                'arrayDropdownsInstructor' => $arrayDropdowns,
                'arrayCheckboxesInstructor' => $arrayCheckboxes,
                'id' => $course->id_course,
                'buttonInstructor' => '',
            ])
        @endcomponent
    @endif
@endsection
