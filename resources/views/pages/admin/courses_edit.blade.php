@extends('layout.admin')

@php
$arrayInputs = [
    [
        'label' => 'Course',
        'type' => 'text',
        'name' => 'courseName',
        'placeholder' => 'Enter course name',
        'value' => $course->course_name
    ],
    [
        'label' => 'Price',
        'type' => 'text',
        'name' => 'coursePrice',
        'placeholder' => 'Enter course price',
        'value' => $course->price
    ],
    [
        'label' => 'Hours',
        'type' => 'text',
        'name' => 'courseHours',
        'placeholder' => 'Enter total hours',
        'value' => $course->total_hours
    ],
    [
        'label' => 'Course Image',
        'type' => 'file',
        'name' => 'courseImage',
        'folder' => 'courses/',
        'image' => $course->image_small,
    ],
];

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
    //dd($ct);
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
    @component('components.admin.form', [
        'headTitle' => 'Courses',
        'title' => 'Edit Course',
        'method' => 'PUT',
        'action' => 'courses.update',
        'arrayInputs' => $arrayInputs,
        'arrayDropdowns' => $arrayDropdowns,
        'arrayCheckboxes' => $arrayCheckboxes,
        'id' => $course->id_course,
        'button' => ''
    ])@endcomponent
@endsection

