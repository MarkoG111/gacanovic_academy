@extends('layout.admin')

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
        'type' => 'text',
        'name' => 'coursePrice',
        'placeholder' => 'Enter course price',
    ],
    [
        'label' => 'Hours',
        'type' => 'text',
        'name' => 'courseHours',
        'placeholder' => 'Enter total hours',
    ],
    [
        'label' => 'Course Image',
        'type' => 'file',
        'name' => 'courseImage'
    ],
];



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

    @component('components.admin.form', [
        'headTitle' => 'Courses',
        'title' => 'Add New Course',
        'method' => 'POST',
        'action' => 'courses.store',
        'arrayInputs' => $arrayInputs,
        'arrayDropdowns' => $arrayDropdowns,
        'arrayCheckboxes' => $arrayCheckboxes,
        'button' => '',
    ]) @endcomponent

@endsection

