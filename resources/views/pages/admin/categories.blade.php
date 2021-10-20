@extends('layout.admin')

@php
$arrayInputs = [
    [
        'label' => 'Category',
        'type' => 'text',
        'name' => 'categoryName',
        'placeholder' => 'Enter category name',
    ],
    [
        'label' => 'Category Image',
        'type' => 'file',
        'name' => 'categoryImage'
    ],
];
@endphp

@section('content')
    @component('components.admin.form', [
        'headTitle' => 'Categories',
        'title' => 'Add New Category',
        'method' => 'POST',
        'action' => 'categories.store',
        'arrayInputs' => $arrayInputs,
        'button' => '',
    ]) @endcomponent
@endsection



