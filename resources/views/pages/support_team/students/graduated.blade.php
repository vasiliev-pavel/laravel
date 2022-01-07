@extends('layouts.master')
@section('page_title', 'Выпускники')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Выпускники</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-students" class="nav-link active" data-toggle="tab"> Все выпускники</a></li>
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
            <div class="tab-pane fade show active" id="all-students">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Фото</th>
                        <th>ФИО</th>
                        <th>Класс</th>
                        <th>Год выпуска</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $s->user->photo }}" alt="photo"></td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->my_class->name.' '.$s->section->name }}</td>
                        <td>{{ $s->grad_date }}</td>
                        <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                           
                                            @if(Qs::userIsTeamSA())
                                                {{--Not Graduated--}}
                                                <a id="{{ Qs::hash($s->id) }}" href="#" onclick="$('form#ng-'+this.id).submit();" class="dropdown-item"><i class="icon-stairs-down"></i> Отменить перевод</a>
                                                <form method="post" id="ng-{{ Qs::hash($s->id) }}" action="{{ route('st.not_graduated', Qs::hash($s->id)) }}" class="hidden">@csrf @method('put')</form>
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

            @foreach($my_classes as $mc)
            <div class="tab-pane fade" id="c{{$mc->id}}">                                      <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                    <th>№</th>
                        <th>Фото</th>
                        <th>ФИО</th>
                        <th>Класс</th>
                        <th>Год выпуска</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students->where('my_class_id', $mc->id) as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $s->user->photo }}" alt="photo"></td>
                            <td>{{ $s->user->name }}</td>
                           
                            <td>{{ $s->my_class->name.' '.$s->section->name }}</td>
                            <td>{{ $s->grad_date }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                           
                                            @if(Qs::userIsTeamSA())
                                                {{--Not Graduated--}}
                                                <a id="{{ Qs::hash($s->id) }}" href="#" onclick="$('form#ng-'+this.id).submit();" class="dropdown-item"><i class="icon-stairs-down"></i> Отменить перевод</a>
                                                <form method="post" id="ng-{{ Qs::hash($s->id) }}" action="{{ route('st.not_graduated', Qs::hash($s->id)) }}" class="hidden">@csrf @method('put')</form>
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

{{--Student List Ends--}}

@endsection
