@extends('layouts.master')
@section('page_title', 'Редактирование группы '.$s->my_class->name)
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Редактирование группы {{ $s->my_class->name }}а</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form class="ajax-update" method="post" action="{{ route('sections.update', $s->id) }}">
                    @csrf @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Название группы <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="name" value="{{ $s->name }}" required type="text" class="form-control" placeholder="Название группы">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Класс </label>
                        <div class="col-lg-9">
                            <input class="form-control" id="my_class_id" disabled="disabled" type="text" value="{{ $s->my_class->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Учитель</label>
                        <div class="col-lg-9">
                            <select data-placeholder="Выбрать учителя" class="form-control select-search" name="teacher_id" id="teacher_id">
                                <option value=""></option>
                                @foreach($teachers as $t)
                                <option {{ $s->teacher_id == $t->id ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <button  class="btn btn-primary">Редактировать группы<i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--Section Edit Ends--}}

@endsection