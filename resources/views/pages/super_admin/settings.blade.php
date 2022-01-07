@extends('layouts.master')
@section('page_title', 'Управление системными настройками')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title font-weight-semibold">Обновить данные</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <form enctype="multipart/form-data" method="post" action="{{ route('settings.update') }}">
            @csrf @method('PUT')
          
                <div class="col-md-6 border-right-2 border-right-blue-400">
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-3 col-form-label font-weight-semibold">Текущий год <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select data-placeholder="Выбрать..." required name="current_session" id="current_session" class="select-search form-control">
                                <option value=""></option>
                                @for($y=date('Y', strtotime('- 1 years')); $y<=date('Y', strtotime('+ 5 years')); $y++) <option {{ ($s['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Телефон школы</label>
                        <div class="col-lg-9">
                            <input name="phone" value="{{ $s['phone'] }}" type="text" class="form-control" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Электронная почта школы</label>
                        <div class="col-lg-9">
                            <input name="system_email" value="{{ $s['system_email'] }}" type="email" class="form-control" placeholder="Электронная почта">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Адрес школы <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input required name="address" value="{{ $s['address'] }}" type="text" class="form-control" placeholder="Адрес школы">
                        </div>
                    </div>

                    <div class="text-right">
                    <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>  
                </div>
        </form>
    </div>
</div>

{{--Settings Edit Ends--}}

@endsection