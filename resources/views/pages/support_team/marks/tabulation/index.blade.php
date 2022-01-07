@extends('layouts.master')
@section('page_title', 'Просмотр оценок')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-books mr-2"></i> Просмотр оценок</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
        <form method="post" action="{{ route('marks.tabulation_select') }}">
                    @csrf
                    <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exam_id" class="col-form-label font-weight-bold">Тип работы:</label>
                                            <select required id="exam_id" name="exam_id" class="form-control select" data-placeholder="Выбрать">
                                                @foreach($exams as $exm)
                                                    <option {{ ($selected && $exam_id == $exm->id) ? 'selected' : '' }} value="{{ $exm->id }}">{{ $exm->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="my_class_id" class="col-form-label font-weight-bold">Класс:</label>
                                            <select onchange="getClassSections(this.value)" required id="my_class_id" name="my_class_id" class="form-control select" data-placeholder="Выбрать">
                                                <option value=""></option>
                                                @foreach($my_classes as $c)
                                                    <option {{ ($selected && $my_class_id == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id" class="col-form-label font-weight-bold">Группа:</label>
                                <select required id="section_id" name="section_id" data-placeholder="Выбрать" class="form-control select">
                                    @if($selected)
                                        @foreach($sections->where('my_class_id', $my_class_id) as $s)
                                            <option {{ $section_id == $s->id ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-md-2 mt-4">
                            <div class="text-right mt-1">
                                <button  class="btn btn-primary">Просмотр оценок <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>

                    </div>

                </form>
        </div>
    </div>

    {{--if Selction Has Been Made --}}

    @if($selected)
        <div class="card">
            <div class="card-header">
                <h6 class="card-title font-weight-bold">Список оценок для  {{ $my_class->name.' '.$section->name.' - '.$ex->name.' ('.$year.')' }}</h6>
            </div>
            <div class="card-body"> 
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>ФИО</th>
                       @foreach($subjects as $sub)
                       <th title="{{ $sub->name }}" rowspan="2">{{ strtoupper($sub->slug ?: $sub->name) }}</th>
                       @endforeach
                      
                       <th>Первое задание </th>
                        <th>Второе задание </th>
                        <th>Третье задание </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marks->sortBy('user.name') as $mk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mk->user->name }} </td>
                                
                                        <td> </td>
                                
                        {{--                CA AND EXAMS --}}
                                        <td>{{ $mk->t1 }}</td>
                                        <td>{{ $mk->t2 }}</td>
                                        <td>{{ $mk->exm }}</td>

            </tr>
        @endforeach
                    </tbody>
                </table>
                </div>
        </div>
    @endif
@endsection
