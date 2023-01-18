<div class="header-instructor">
    <div class="row">
        <div class="col-6">
            <img src="{{ asset('/img/logo-learnings.png') }}" class="img-fluid" />
        </div>
        <div class="col-6 flex-link">
            <a class="exit-url" href="{{ url('/') }}">Exit</a>
        </div>
    </div>
</div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 centerText">
            <div class="col-sm-6 centerTitle">
                <h1>{{ $pageTitleInstructor }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="content content-wrapper-instructor">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header bckg">
                    <h3 class="card-title centerTitle">{{ $formTitleInstructor }}</h3>
                </div>

                <div class="card-body">
                    @if (isset($id))
                        <form action="{{ route($actionInstructor, $id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idCourseHdn" value="{{ $id }}">
                    @else
                        <form action="{{ route($actionInstructor) }}" method="POST" enctype="multipart/form-data">
                    @endif

                    @method($methodInstructor)

                    @csrf

                    @if (isset($arrayInputsInstructor))
                        @foreach ($arrayInputsInstructor as $input)
                            <div class="form-group">
                                @if (!isset($input['noLabel']))
                                    <label>{{ $input['label'] ?? '' }}</label>
                                @endif

                                @if (isset($input['image']))
                                    <img src="{{ asset("/img/".$input['folder'] . $input['image'] ?? '') }}" alt="{{ $input['name'] ?? '' }}" class="small-img" />
                                @endif

                                @if (($input['type']) == 'textarea')
                                    <textarea name="{{ $input['name'] }}" value="" placeholder="" class="form-control" cols="25" rows="10">{{ $input['value'] ?? '' }} </textarea>
                                @endif

                                @if (($input['type']) !== 'textarea')
                                    <input type="{{ $input['type'] ?? 'text' }}" class="form-control"
                                        id="{{ $input['id'] ?? '' }}" value="{{ $input['value'] ?? '' }}"
                                        name="{{ $input['name'] ?? '' }}"
                                        step=".01"
                                        placeholder="{{ $input['placeholder'] ?? '' }}" />
                                @endif
                            </div>
                        @endforeach
                    @endif


                    @if (isset($arrayLessonsInstructor))
                        @foreach ($arrayLessonsInstructor as $lesson)
                            <div class="form-group lessonRow row" id="lesson">
                                <div class="col-11">
                                    <label>{{ $lesson->label ?? '' }}</label>

                                    <input type="{{ $lesson->type ?? 'text' }}" class="form-control mb-8"
                                        id="{{ $lesson->value ?? '' }}" value="{{ $lesson->text ?? '' }}"
                                        name="{{ $lesson->name ?? '' }}"
                                        placeholder="{{ $lesson->placeholder ?? '' }}" />
                                </div>
                            </div>

                            <div class="center-align centeredBtn">
                                <button type="button" class="btn blue" id="btnAddLesson"><i class="fa fa-plus"></i></button>
                            </div>
                        @endforeach
                    @endif

                    @if (isset($arrayLessonsEdit))
                        @foreach ($arrayLessonsEdit as $arl)
                        <label>{{ $arl->label ?? '' }}</label>

                            @if (isset($arl->option))
                                @foreach ($arl->option as $option)
                                    <div class="form-group lessonRow row" id="{{ $option['value'] }}">
                                        <div class="col-11">
                                            <input type="text" class="form-control mb-8"
                                                id="{{ $option['value'] ?? '' }}"
                                                value="{{ $option['text'] ?? '' }}"
                                                step=".01"
                                                name="{{ $arl->name ?? '' }}" />
                                        </div>

                                        <div class="col-1">
                                            <button type="button" class="btn btnRemoveLessonFromEdit" data-id='{{ $option['value'] }}'><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                        <div class="center-align centeredBtn">
                            <button type="button" class="btn blue" id="btnAddLesson"><i class="fa fa-plus"></i></button>
                        </div>
                    @endif

                    @if (isset($arrayDropdownsInstructor))
                        @foreach ($arrayDropdownsInstructor as $dd)
                            <div class="form-group">
                                <label>{{ $dd->label ?? '' }}</label>

                                <select name="{{ $dd->name }}"  class="form-control">
                                    <option value="0">Choose</option>

                                    @foreach ($dd->option as $option)
                                        @if (isset($dd->selected))
                                            @if ($option['value'] == $dd->selected)
                                                <option selected value="{{ $option['value'] ?? '' }}">{{ $option['text'] }}</option>
                                            @else
                                                <option value="{{ $option['value'] ?? '' }}">{{ $option['text'] }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $option['value'] ?? '' }}">{{ $option['text'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    @endif

                    @if (isset($arrayCheckboxesInstructor))
                        @foreach ($arrayCheckboxesInstructor as $chb)
                            <div class="form-group chb-display">
                                <label>{{ $chb->label ?? '' }}</label>
                                <div class="d-flex justify-content-around flex-wrap">
                                    @foreach ($chb->option as $input)
                                        @if (in_array($input['value'], $chb->selected ?? []))
                                            <span class="w-100 m-1"><input type="checkbox"
                                                    name="{{ $chb->name ?? '' }}"
                                                    value="{{ $input['value'] ?? '' }}" class="mr-2"
                                                    checked="checked" />{{ $input['text'] ?? '' }}</span>
                                        @else
                                            <span class="w-100 m-1"><input type="checkbox"
                                                    name="{{ $chb->name ?? '' }}"
                                                    value="{{ $input['value'] ?? '' }}"
                                                    class="mr-2" />{{ $input['text'] ?? '' }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (isset($buttonInstructor))
                        <div class="form-group">
                            <button type="{{ $buttonInstructor['type'] ?? 'submit' }}" name="{{ $buttonInstructor['name'] ?? '' }}"
                                id="{{ $buttonInstructor['id'] ?? '' }}"
                                class="btn btn-primary {{ $buttonInstructor['class'] ?? '' }}">{{ $buttonInstructor['value'] ?? 'Submit' }}</button>
                        </div>
                    @endif
                    </form>
                </div>

                <div class="card-footer">
                    <div class="js-notification"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger pr mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-hover">

                    </table>
                    <div class="dataTables_paginate paging_simple_numbers pt-3" id="table_paginate">

                    </div>
                    <div class="msgCrud">
                        @if (session()->has('updateMsg'))
                            {{ session()->get('updateMsg') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
