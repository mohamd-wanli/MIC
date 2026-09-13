@extends('layouts.master')
@section('title')
    قائمة الأقسام
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <style>
        .hidden {
            display: none
        }
    </style>
    <div class="card-header pb-0 row">
        <div class="col-2">
            @can('اضافة قسم')
            <a href="{{ route('createdepartment') }}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                class="fas fa-plus"></i>&nbsp; اضافة قسم</a><br><br>  
            @endcan
           
        </div>
    </div>
    <table class="table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                {{-- <th scope="col">المعرف</th> --}}
                <th scope="col">اسم القسم</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    {{-- <td>{{ $subject->id }}</td> --}}
                    <td>{{ $department->name }}</td>
                    <td>
                        @can('تعديل قسم')
                        <a href="{{ route('editdep', ['id' => $department->id]) }}" class="btn btn-primary">تعديل</a>  
                        @endcan
                        @can('حذف قسم')
                        <a href="{{ route('deletedepartment', ['id' => $department->id]) }}" class="btn btn-primary">حذف</a>     
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </br>
    {{-- <script src="{{ asset('assests/js/jquery-3.7.1.js') }}"></script>

<script>
   $( document ).ready(function() {
    const sectionSelect = document.getElementById('section');
    sectionSelect.addEventListener('change', (e) => {
                      var id = $('#section').find(":selected").val();
                        var url1 = '{{ route('shows1', ['id' => ':id']) }}';
                        url = url1.replace(':id', id);
                        
                        $.get( url, function(d) {
                          console.log(d);
                            if(d.length>0) {
                              $('#table').find('tr:not(:first)').remove(); 
                              $("#table").removeClass("hidden");
                              $("#table").addClass("table");
                              
                              for(let i = 0; i < d.length;i++){
                                  var id= d[i].id;
                                  var urled = '{{ route('editsub', ['id' => ':id']) }}';
                                  urlk = urled.replace(':id', id );

                                  var urle= '{{ route('deletesubject', ['id' => ':id']) }}';
                                  urlg = urle.replace(':id', id );
                                  // console.log(urlk);
                                  var newRow ="<tr>"+
                                               "<td>"+d[i].name+"</td>" +
                                               "<td><div><a href="+urlk+" class='btn btn-primary' style='display:inline-block'>تعديل </a>&nbsp;<a href="+urlg+" class='btn btn-primary' style='display:inline-block'>حذف </a></div></td>" +
                                              +"</tr>";
                                  $("#table tbody").append(newRow);
                                                  }  
                            }                       

                        });
                      });       
                      });       
</script> --}}
@endsection
