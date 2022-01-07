<form class="ajax-update" action="{{ route('marks.update', [$exam_id, $my_class_id, $section_id, $subject_id]) }}" method="post">
    @csrf @method('put')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>ФИО</th>

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
           

{{--                CA AND EXAMS --}}
                <td><input title="1ST CA" min="2" max="5" class="text-center" name="t1_{{ $mk->id }}" value="{{ $mk->t1 }}" type="number"></td>
                <td><input title="2ND CA" min="2" max="5" class="text-center" name="t2_{{ $mk->id }}" value="{{ $mk->t2 }}" type="number"></td>
                <td><input title="EXAM" min="2" max="5" class="text-center" name="exm_{{ $mk->id }}" value="{{ $mk->exm }}" type="number"></td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center mt-2">
        <button  class="btn btn-primary">Обновить данные<i class="icon-paperplane ml-2"></i></button>
    </div>
</form>
