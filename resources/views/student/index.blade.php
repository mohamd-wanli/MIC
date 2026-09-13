@extends('layouts.master')
@section('title')
    قائمة البحث
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error" role="alert">

            {{ session('error') }}
        </div>
    @endif


    <style>
        .search-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }

        .search-container label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .search-container input {
            width: 100%;
            height: 40px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-item {
            display: flex;
            flex-direction: column;
            width: 30%;
        }

        .search-button {
            width: 30%;
            padding: 12px 20px;
            background-color: royalblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            align-self: center;
            margin-top: 20px;
        }

        .search-button:hover {
            background-color: darkblue;
        }
    </style>

    <div class="search-container">
        <div class="search-item">
            <label for="searchbyfirstname" class="control-label">الاسم الأول</label>
            <input type="text" name="searchbyfirstname" id="searchbyfirstname" placeholder="بحث عن الاسم الأول">
        </div>
        <div class="search-item">
            <label for="searchbyfathername" class="control-label">اسم الأب</label>
            <input type="text" name="searchbyfathername" id="searchbyfathername" placeholder="بحث عن اسم الأب">
        </div>
        <div class="search-item">
            <label for="searchbylastname" class="control-label">الكنية</label>
            <input type="text" name="searchbylastname" id="searchbylastname" placeholder="بحث عن الكنية">
        </div>
        <div class="search-item">
            <label for="searchbyfullname" class="control-label">الاسم الكامل</label>
            <input type="text" name="searchbyfullname" id="searchbyfullname" placeholder="بحث عن الاسم الكامل">
        </div>
        <div class="search-item">
            <label for="searchbynational_number" class="control-label">الرقم الوطني</label>
            <input type="text" name="searchbynational_number" id="searchbynational_number"
                placeholder="بحث عن الرقم الوطني">
        </div>
        <div class="search-item">
            <label for="searchbySkillcard" class="control-label">بطاقة المهارات</label>
            <input type="text" name="searchbySkillcard" id="searchbySkillcard" placeholder="بحث عن بطاقة المهارات">
        </div>
        <button id="onclick" class="search-button">بحث</button>
    </div>

    {{-- <div style="text-align: center;" >
  <a href="{{route ('adv_search')}}" style="font-size: 22px; margin: 0px; color: white ; width: 30%; height: 40px; background-color: royalblue;" class="btn btn-sm btn-info">بحث متقدم</a>

</div> --}}


    <div id="ajax_search_result">
        <br>
    </div>








    <script src="{{ asset('/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#onclick').on('click', function() {
                const searchbyfirstname = $('#searchbyfirstname').val();
                const searchbyfathername = $('#searchbyfathername').val();
                const searchbylastname = $('#searchbylastname').val();
                const searchbyfullname = $('#searchbyfullname').val();
                const searchbynational_number = $('#searchbynational_number').val();
                const searchbySkillcard = $('#searchbySkillcard').val();

                if (searchbyfirstname === "" && searchbyfathername === "" && searchbylastname === "" &&
                    searchbyfullname === "" && searchbynational_number === "" && searchbySkillcard === "") {
                    $('#resultsTable tbody').empty();
                } else {
                    const formData = {
                        searchbyfirstname: searchbyfirstname,
                        searchbyfathername: searchbyfathername,
                        searchbylastname: searchbylastname,
                        searchbyfullname: searchbyfullname,
                        searchbynational_number: searchbynational_number,
                        searchbySkillcard: searchbySkillcard,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    jQuery.ajax({
                        url: '{{ route('ajax_search_student') }}',
                        type: 'post',
                        datatype: 'html',
                        cache: false,
                        data: formData,
                        success: function(data) {
                            $('#resultsTable tbody').empty();
                            $("#ajax_search_result").html(data);
                        },
                        error: function() {}
                    });
                }
            });

            $(document).on('click', "#ajax_search_pagination a", function(e) {
                e.preventDefault();

                const formData = {
                    searchbyfirstname: $('#searchbyfirstname').val(),
                    searchbyfathername: $('#searchbyfathername').val(),
                    searchbylastname: $('#searchbylastname').val(),
                    searchbyfullname: $('#searchbyfullname').val(),
                    searchbynational_number: $('#searchbynational_number').val(),
                    searchbySkillcard: $('#searchbySkillcard').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                jQuery.ajax({
                    url: $(this).attr('href'),
                    type: 'post',
                    datatype: 'html',
                    cache: false,
                    data: formData,
                    success: function(data) {
                        $("#ajax_search_result").html(data);
                    },
                    error: function() {}
                });
            });
        });
    </script>
@endsection
