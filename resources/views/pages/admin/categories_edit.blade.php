@extends('layout.admin')

@php
$arrayInputs = [
    [
        'label' => 'Category',
        'type' => 'text',
        'name' => 'categoryName',
        'placeholder' => 'Enter category name',
        'value' => $category->category_name,
    ],
    [
        'label' => 'Category Image',
        'type' => 'file',
        'name' => 'categoryImage',
        'folder' => 'categories/',
        'image' => $category->category_image,
    ],
];
@endphp

@section('content')
    @component('components.admin.form', [
        'headTitle' => 'Categories',
        'title' => 'Edit Category',
        'method' => 'PUT',
        'action' => 'categories.update',
        'arrayInputs' => $arrayInputs,
        'id' => $category->id_category,
        'button' => '',
    ])@endcomponent
@endsection

