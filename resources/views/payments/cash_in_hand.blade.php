@extends('layouts.master')

@section('title', 'العهدة الحالية')

@section('content')
<div class="container-fluid px-3 px-md-4">

    <div class="card" style="border:none; border-radius:16px; box-shadow:0 4px 25px rgba(0,0,0,.08);">
        <div class="card-body">

            <h3 style="font-weight:700;">
                <i class="fas fa-wallet" style="color:#667eea;"></i>
                النقدية في العهدة
            </h3>
            <p style="color:#6c757d;">إجمالي الإيصالات التي لم يتم تسليمها للصندوق بعد</p>

            <table class="table" style="margin-top:20px;">
                <thead style="background:#1a1a2e; color:#fff;">
                    <tr>
                        <th>القسم</th>
                        <th>عدد الإيصالات</th>
                        <th>الإجمالي (ل.س)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rows as $row)
                        <tr>
                            <td>{{ $row->department->name ?? 'غير محدد' }}</td>
                            <td>{{ $row->receipts_count }}</td>
                            <td><strong>{{ number_format($row->total_amount) }} ل.س</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد إيصالات في العهدة حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
