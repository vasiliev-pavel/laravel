@extends('layouts.master')
@section('page_title', 'Аннулирование переводов')
@section('content')

    {{--Reset All--}}
    <div class="card">
        <div class="card-body text-center
">
            <button id="promotion-reset-all" class="btn btn-danger btn-large">Сбросить все переводы</button>
        </div>
    </div>

{{-- Reset Promotions --}}
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">Аннулирование переводов учеников</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">

            <table id="promotions-list" class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Фото</th>
                    <th>ФИО</th>
                    <th>Из класса</th>
                    <th>В класс</th>
                    <th>Статус</th>
                    <th class="text-center">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions->sortBy('fc.name')->sortBy('student.name') as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $p->student->photo }}" alt="photo"></td>
                        <td>{{ $p->student->name }}</td>
                        <td>{{ $p->fc->name.' '.$p->fs->name }}</td>
                        <td>{{ $p->tc->name.' '.$p->ts->name }}</td>
                        @if($p->status === 'P')
                            <td><span class="text-success">Переведён</span></td>
                        @elseif($p->status === 'D')
                            <td><span class="text-danger">Не переведен</span></td>
                        @else
                            <td><span class="text-primary">Выпускник</span></td>
                        @endif
                        <td class="text-center">
                            <button data-id="{{ $p->id }}" class="btn btn-danger promotion-reset">Сбросить</button>
                            <form id="promotion-reset-{{ $p->id }}" method="post" action="{{ route('students.promotion_reset', $p->id) }}">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        /* Single Reset */
        $('.promotion-reset').on('click', function () {
            let pid = $(this).data('id');
            if (confirm('Вы уверены, что хотите продолжить?')){
                $('form#promotion-reset-'+pid).submit();
            }
            return false;
        });

        /* Reset All Promotions */
        $('#promotion-reset-all').on('click', function () {
            if (confirm('Вы уверены, что хотите продолжить?')){
                $.ajax({
                    url:"{{ route('students.promotion_reset_all') }}",
                    type:'DELETE',
                    data:{ '_token' : $('#csrf-token').attr('content') },
                    success:function (resp) {
                        $('table#promotions-list > tbody').fadeOut().remove();
                        flash({msg : resp.msg, type : 'success'});
                    }
                })
            }
            return false;
        })
    </script>
@endsection
