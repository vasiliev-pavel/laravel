@extends('layouts.master')
@section('page_title', 'Редактировать - '.$dorm->name)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Редактирование секции</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-update" data-reload="#page-header" method="post" action="{{ route('dorms.update', $dorm->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Название <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ $dorm->name }}" required type="text" class="form-control" placeholder="Название">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Описание</label>
                            <div class="col-lg-9">
                                <input name="description" value="{{ $dorm->description }}"  type="text" class="form-control" placeholder="Описание">
                            </div>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary">Редактировать<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Class Edit Ends--}}

@endsection
