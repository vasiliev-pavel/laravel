@extends('layouts.master')
@section('page_title', 'Добавить ученика')
@section('content')
<div class="card">
    <div class="card-header bg-white header-elements-inline">
        <h6 class="card-title">Пожалуйста, заполните форму ниже, чтобы добавить нового ученика</h6>

        {!! Qs::getPanelOptions() !!}
    </div>

    <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.store') }}" data-fouc>
        @csrf
        <h6>Персональные данные</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>ФИО: <span class="text-danger">*</span></label>
                        <input value="{{ old('name') }}" required type="text" name="name" placeholder="ФИО" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Адрес: <span class="text-danger">*</span></label>
                        <input value="{{ old('address') }}" class="form-control" placeholder="Адрес" name="address" type="text" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Электронная почта: </label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Электронная почта">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="password">Пароль: </label>
                            <input id="password" type="password" name="password" class="form-control"  >
                    </div>
                </div>

               

            </div>

            <div class="row">
                 <div class="col-md-3">
                    <div class="form-group">
                        <label>Номер телефона:</label>
                        <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="Номер телефона">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gender">Пол: <span class="text-danger">*</span></label>
                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Выбрать..">
                            <option value=""></option>
                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Мужчина">Мужчина</option>
                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Женщина">Женщина</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Дата рождения:</label>
                        <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="Выбрать дату...">

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="d-block">Загрузить фото паспорта:</label>
                        <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                    </div>
                </div>

            </div>

        </fieldset>

        <h6>Данные ученика</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="my_class_id">Класс: <span class="text-danger">*</span></label>
                        <select onchange="getClassSections(this.value)" data-placeholder="Выбрать..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                            <option value=""></option>
                            @foreach($my_classes as $c)
                            <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="section_id">Группа: <span class="text-danger">*</span></label>
                        <select data-placeholder="Выбрать группу" required name="section_id" id="section_id" class="select-search form-control">
                            <option {{ (old('section_id')) ? 'selected' : '' }} value="{{ old('section_id') }}">{{ (old('section_id')) ? 'Selected' : '' }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="my_parent_id">Родитель: </label>
                        <select data-placeholder="Выбрать..." name="my_parent_id" id="my_parent_id" class="select-search form-control">
                            <option value=""></option>
                            @foreach($parents as $p)
                            <option {{ (old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="year_admitted">Год добавления: <span class="text-danger">*</span></label>
                        <select data-placeholder="Выбрать..." required name="year_admitted" id="year_admitted" class="select-search form-control">
                            <option value=""></option>
                            @for($y=date('Y', strtotime('- 10 years')); $y<=date('Y'); $y++) <option {{ (old('year_admitted') == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="dorm_id">Секции: </label>
                    <select data-placeholder="Выбрать..." name="dorm_id" id="dorm_id" class="select-search form-control">
                        <option value=""></option>
                        @foreach($dorms as $d)
                        <option {{ (old('dorm_id') == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </fieldset>

    </form>
</div>
@endsection