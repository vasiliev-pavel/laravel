@extends('layouts.master')
@section('page_title', 'Управление оценками')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><i class="icon-books mr-2"></i> Управление оценками</h5>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        @include('pages.support_team.marks.selector')
    </div>
</div>
@endsection