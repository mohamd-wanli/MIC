<form action="{{ route('session_number.store') }}" method="POST">
    @csrf
    <label for="exam_day_id">يوم الامتحان:</label>
    <select name="exam_day_id" id="exam_day_id">
        @foreach ($exam as $examDay)
            <option value="{{ $examDay->id }}">{{ $examDay->id }}</option>
        @endforeach
    </select>

    <label for="session_name">اسم الجلسة:</label>
    <input type="text" name="session_name" id="session_name">

    <button type="submit">إضافة جلسة</button>
</form>
