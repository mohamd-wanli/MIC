<tr id="payment-row-<?php echo e($payment->id); ?>">
    <td><?php echo e($paymentCount ?? 1); ?></td>
    <td><?php echo e($payment->course->subject_name ?? '—'); ?></td>
    <td><strong><?php echo e(number_format($payment->payment_value)); ?> ج.م</strong></td>
    <td>
        <span class="status-badge info">
            <?php switch($payment->payment_type):
                case ('cash'): ?> 💰 نقدي <?php break; ?>
                <?php case ('visa'): ?> 💳 بطاقة <?php break; ?>
                <?php case ('bank'): ?> 🏦 تحويل <?php break; ?>
                <?php case ('cheque'): ?> 📝 شيك <?php break; ?>
                <?php default: ?> <?php echo e($payment->payment_type); ?>

            <?php endswitch; ?>
        </span>
    </td>
    <td><?php echo e($payment->created_at ? $payment->created_at->format('Y-m-d h:i A') : '—'); ?></td>
    <td>
        <button class="table-action-btn btn-danger-sm" onclick="deletePayment(<?php echo e($payment->id); ?>, <?php echo e($payment->student_id); ?>)">
            <i class="fas fa-trash-alt"></i> حذف
        </button>
    </td>
</tr>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/partials/payment_row.blade.php ENDPATH**/ ?>