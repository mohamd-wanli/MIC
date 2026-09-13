@extends('layouts.master')
@section('title')
    تعديل فاتورة
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form method="post"action="{{ route('updateinv', $inv->id) }}" style="width: 80%; margin:auto;" class="needs-validation"
        novalidate>
        @csrf
        <br>
        <label for="coname">اسم الدورة</label>
        <input type="text" value="{{ $inv->course_name }}" name="coname" class="form-control" readonly>
        <br>
        <label for="stuname">اسم الطالب</label>
        <input type="text" value="{{ $inv->student_name }}" name="stuname" class="form-control" readonly>
        <br>
        <label for="sale">الحسم</label>
        <input type="text" value="{{ $sale }}" name="sale" class="form-control" readonly>
        <br>
        <label for="paymenttype" class="form-label">نوع الدفعة</label>
        <select id="paymenttype" class="form-select form-select-lg mb-3" name="paymenttype" required>
            <option value="{{ $inv->payment_type }}" selected>{{ $inv->payment_type }}</option>
            @if ($inv->payment_type != 'قسط')
                <option value="قسط">قسط</option>
            @endif
            @if ($inv->payment_type != 'قسط+رسم')
                <option value="قسط+رسم">قسط+رسم</option>
            @endif
            @if ($inv->payment_type != 'قسط نهائي')
                <option value="قسط نهائي">قسط نهائي</option>
            @endif
            @if ($inv->payment_type != 'رسم شهادة أمريكية')
                <option value="رسم شهادة أمريكية">رسم شهادة أمريكية</option>
            @endif
            @if ($inv->payment_type != 'رسم شهادة حرفية')
                <option value="رسم شهادة حرفية">رسم شهادة حرفية</option>
            @endif
            @if ($inv->payment_type != 'ثمن نوطة')
                <option value="ثمن نوطة">ثمن نوطة</option>
            @endif
            @if ($inv->payment_type != 'وثيقة دوام')
                <option value="وثيقة دوام">وثيقة دوام</option>
            @endif
        </select>
        {{-- @error('paymenttype')
                        <p class="error" style="color: red">{{ $message }}</p>    
                        @enderror --}}
        <br>
        <label for="paymentamount">قيمة الدفعة</label>
        <input type="number" id="paymentamount" name="paymentamount" class="form-control"
            value="{{ $inv->payment_amount }}" required>
        {{-- @error('paymentamount')
                        <p class="error" style="color: red">{{ $message }}</p>    
                        @enderror --}}
        <br>
        <label for="paymentdate">تاريخ الدفعة</label>
        <input type="date" id="paymentdate" name="paymentdate" class="form-control" value="{{ $inv->payment_date }}"
            required>
        {{-- @error('paymentdate')
                        <p class="error" style="color: red">{{ $message }}</p>    
                        @enderror --}}
        <br>
        <label for="invoicenum">رقم الوصل</label>
        <input type="number" id="invoicenum" name="invoicenum" class="form-control" value="{{ $inv->invoice_num }}"
            required>
        {{-- @error('invoicenum')
                        <p class="error" style="color: red">{{ $message }}</p>    
                        @enderror --}}
        <br>
        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
@endsection
