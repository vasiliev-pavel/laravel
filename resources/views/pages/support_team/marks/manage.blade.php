@extends('layouts.master')
@section('page_title', 'Управление оценками')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">Заполните поля для оценок</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @include('pages.support_team.marks.selector')
        </div>
    </div>

    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-md-4"><h6 class="card-title"><strong>Предмет: </strong> {{ $m->subject->name }}</h6></div>
                <div class="col-md-4"><h6 class="card-title"><strong>Класс: </strong> {{ $m->my_class->name.' '.$m->section->name }}</h6></div>
                <div class="col-md-4"><h6 class="card-title"><strong>Тип работы: </strong> {{ $m->exam->name.' - '.$m->year }}</h6></div>
            </div>
        </div>

        <div class="card-body">
            @include('pages.support_team.marks.edit')
            {{--@include('pages.support_team.marks.random')--}}
        </div>
    </div>

    {{--Marks Manage End--}}

@endsection
