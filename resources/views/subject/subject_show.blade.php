<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subject as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->name }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
</br>

<div>
    <a href="{{ route('showsubject') }}">show subject</a>
</div>



<script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
