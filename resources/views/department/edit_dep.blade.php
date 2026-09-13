@extends('layouts.master')
@section('title')
تعديل قسم
@endsection
@section('content')
@if (session('success'))
<p  style="color:green">{{session('success')}}</p>
@elseif (session('delete'))
<p  style="color:red" >{{session('delete')}}</p>
@elseif (session('error'))
<p  style="color:red" >{{session('error')}} </p>
@endif
    <form method="post" action="{{ route('updatedepartment',$department->id) }}" class="needs-validation" novalidate style="width: 80%; margin:auto;">
        @csrf
            <label for="name">اسم القسم</label>  
            <input type="text" class="form-control" id="name" name="name" value={{ $department->name }} required></br>  
            <div class="invalid-feedback">
                الرجاء ادخال اسم القسم
            </div>  
        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">تعديل</button>
    </form>
</br>   
@endsection