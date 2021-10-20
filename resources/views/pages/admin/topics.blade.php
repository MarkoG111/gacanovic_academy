@extends('layout.admin')

@php
    $arrayInputs = [
        [
            'label' => 'Topic',
            'type' => 'text',
            'name' => 'topicName',
            'placeholder' => 'Enter topic name'
        ],
    ];
@endphp

@section('content')
    @component('components.admin.form', [
        'headTitle' => 'Topics',
        'title' => 'Add New Topic',
        'method' => 'POST',
        'action' => 'topics.store',
        'arrayInputs' => $arrayInputs,
        'button' => ''
    ])@endcomponent
@endsection

