@extends('layouts.master')
@section('title')
    قائمة الفواتير للطالب
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <div class="card-header row">
        <h1 class = "title">{{ $course_name }}</h1>
        <div class="col-6">
            <table class="table table-bordered align-middle " style="width: 100%;margin-top: 5%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">رقم الدفعة</th>
                        <th scope="col">مقدار الدفعة</th>
                        <th scope="col">تاريخ الدفع</th>
                        <th scope="col">رقم الوصل</th>
                        <th scope="col">نوع الدفعة</th>
                        <th scope="col"> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->payment_amount }}</td>
                            <td>{{ $invoice->payment_date }}</td>
                            <td>{{ $invoice->invoice_num }}</td>
                            <td>{{ $invoice->payment_type }}</td>
                            <td>
                                <a href="{{ route('editinv', ['id' => $invoice->id]) }}" class="btn btn-primary">تعديل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card col-6" style="width: 25%;  margin-right: 21%;">
            <div class="card-body" style="  padding: 30px 15px 20px 20px;">
                <label for="price" direction="rtl">سعر الدورة</label>
                <input type="text" value="{{ $course_price }}" name="price" readonly direction="rtl">
                </br>
                <label for="totalpayment" direction="rtl">مجموع المدفوعات</label>
                <input type="text" value="{{ $totalpayment }}" name="totalpayment" readonly direction="rtl">
                </br>
                <label for="remain_amount" direction="rtl">المبلغ المتبقي</label>
                <input type="text" value="{{ $remain_amount }}" name="remain_amount" readonly direction="rtl">
                </br>
                <label for="sale" direction="rtl">الحسم</label>
                <input type="text" value="{{ $sale }}" name="sale" readonly direction="rtl">
                </br></br>
            </div>
        </div>
    @endsection
