<tr id="payment-row-{{ $payment->id }}">
    <td>{{ $paymentCount ?? 1 }}</td>
    <td>{{ $payment->course->subject_name ?? '—' }}</td>
    <td><strong>{{ number_format($payment->payment_value) }} ج.م</strong></td>
    <td>
        <span class="status-badge info">
            @switch($payment->payment_type)
                @case('cash') 💰 نقدي @break
                @case('visa') 💳 بطاقة @break
                @case('bank') 🏦 تحويل @break
                @case('cheque') 📝 شيك @break
                @default {{ $payment->payment_type }}
            @endswitch
        </span>
    </td>
    <td>{{ $payment->created_at ? $payment->created_at->format('Y-m-d h:i A') : '—' }}</td>
    <td>
        <button class="table-action-btn btn-danger-sm" onclick="deletePayment({{ $payment->id }}, {{ $payment->student_id }})">
            <i class="fas fa-trash-alt"></i> حذف
        </button>
    </td>
</tr>
