@extends('layout.admin')

@php
$arrayInputs = [
    [
        'label' => 'Topic',
        'type' => 'text',
        'name' => 'topicName',
        'placeholder' => 'Enter topic name',
        'value' => $topic->topic_name,
    ],
];
@endphp

@section('content')
    @component('components.admin.form', [
        'headTitle' => 'Topics',
        'title' => 'Edit Topic',
        'method' => 'PUT',
        'action' => 'topics.update',
        'arrayInputs' => $arrayInputs,
        'id' => $topic->id_topic,
        'button' => '',
    ])@endcomponent
@endsection

