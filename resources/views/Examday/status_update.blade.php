@extends('layouts.master')
@section('title')
    تغير حالة اليوم الامتحاني
@stop
@section('content')

<button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
    عودة
</button>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Status_Update', ['id' => $exam->id]) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">حالة اليوم الامتحاني</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option selected="true" disabled="disabled">-- حدد حالة اليوم الامتحاني --</option>
                                    <option value="ملغى">ملغى</option>
                                    <option value="مكتمل">مكتمل </option>
                                </select>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة اليوم الامتحاني</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
