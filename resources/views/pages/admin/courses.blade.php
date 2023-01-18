@extends(session()->get('user')->id_role == 2 ? 'layout.instructor' : 'layout.admin')

@php
    $arrayInputs = [
        [
            'label' => 'Course',
            'type' => 'text',
            'name' => 'courseName',
            'placeholder' => 'Enter course name',
        ],
        [
            'label' => 'Price',
            'type' => 'number',
            'name' => 'coursePrice',
            'placeholder' => 'Enter course price',
        ],
        [
            'label' => 'Hours',
            'type' => 'number',
            'name' => 'courseHours',
            'placeholder' => 'Enter total hours',
        ],
        [
            'label' => 'Course Image',
            'type' => 'file',
            'name' => 'courseImage',
        ],
        [
            'label' => 'Description',
            'type' => 'textarea',
            'name' => 'description',
            'placeholder' => 'Enter description',
        ],
    ];

    $lessonObject = new stdClass();
    if (!$lessons->count() == 0) {
        foreach ($lessons as $l) {
            $lesson[] = ['value' => $l->id_lesson, 'text' => $l->lesson];
        }
        $lessonObject->option = $lesson;
    }
    $lessonObject->type = 'text';
    $lessonObject->name = 'lesson[]';
    $lessonObject->placeholder = 'Enter URL for lesson';
    $lessonObject->label = 'Course Lesson';
    $arrayLessons = [$lessonObject];

    foreach ($categories as $c) {
        $category[] = ['value' => $c->id_category, 'text' => $c->category_name];
    }
    $catObject = new stdClass();
    $catObject->option = $category;
    $catObject->name = 'category';
    $catObject->label = 'Course Category';

    $arrayDropdowns = [$catObject];

    foreach ($topics as $t) {
        $topicsChb[] = ['value' => $t->id_topic, 'text' => $t->topic_name];
    }
    $topicObject = new stdClass();
    $topicObject->option = $topicsChb;
    $topicObject->name = 'topicsChb[]';
    $topicObject->label = 'Course topics';

    $arrayCheckboxes = [$topicObject];

@endphp

@section('content')
    @if (session()->get('user')->id_role == 1)
        @component('components.admin.form',
            [
                'headTitle' => 'Courses',
                'title' => 'Add New Course',
                'method' => 'POST',
                'action' => 'courses.store',
                'arrayInputs' => $arrayInputs,
                'arrayLessons' => $arrayLessons,
                'arrayDropdowns' => $arrayDropdowns,
                'arrayCheckboxes' => $arrayCheckboxes,
                'button' => '',
            ])
        @endcomponent
    @else
        @component('components.instructor.form',
            [
                'pageTitleInstructor' => 'Courses - Instructor',
                'formTitleInstructor' => 'Add New Course',
                'methodInstructor' => 'POST',
                'actionInstructor' => 'instructorStoreCourse',
                'arrayInputsInstructor' => $arrayInputs,
                'arrayLessonsInstructor' => $arrayLessons,
                'arrayDropdownsInstructor' => $arrayDropdowns,
                'arrayCheckboxesInstructor' => $arrayCheckboxes,
                'buttonInstructor' => '',
            ])
        @endcomponent
    @endif
@endsection
