@extends('layouts.master')
@section('page_title', 'Управление группами')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Управление группами</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#new-section" class="nav-link active" data-toggle="tab">Создание новой группы</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Выбрать класс</a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach($my_classes as $c)
                    <a href="#c{{ $c->id }}" class="dropdown-item" data-toggle="tab">{{ $c->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show  active fade" id="new-section">
                <div class="row">
                    <div class="col-md-6">
                        <form class="ajax-store" method="post" action="{{ route('sections.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Название группы <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="Название группы">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Выбрать класс <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select required data-placeholder="Выбрать класс" class="form-control select" name="my_class_id" id="my_class_id">
                                        @foreach($my_classes as $c)
                                        <option {{ old('my_class_id') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Учитель</label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Выбрать учителя" class="form-control select-search" name="teacher_id" id="teacher_id">
                                        <option value=""></option>
                                        @foreach($teachers as $t)
                                        <option {{ old('teacher_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-right">
                                <button  class="btn btn-primary">Создать группу<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($my_classes as $d)
            <div class="tab-pane fade" id="c{{ $d->id }}">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Класс</th>
                            <th>Название группы</th>
                            <th>Учитель</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections->where('my_class.id', $d->id) as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            
                            <td>{{ $s->my_class->name }}</td>
                            <td>{{ $s->name }} @if($s->active)<i class='icon-check'> </i>@endif</td>
                            @if($s->teacher_id)
                            <td><a target="_blank" href="{{ route('users.show', Qs::hash($s->teacher_id)) }}">{{ $s->teacher->name }}</a></td>
                            @else
                            <td> - </td>
                            @endif

                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            {{--edit--}}
                                            @if(Qs::userIsTeamSA())
                                            <a href="{{ route('sections.edit', $s->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Редактировать</a>
                                            @endif
                                            {{--Delete--}}
                                            @if(Qs::userIsSuperAdmin())
                                            <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Удалить</a>
                                            <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('sections.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach

        </div>
    </div>
</div>

{{--Section List Ends--}}

@endsection