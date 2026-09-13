<?php $__env->startSection('title', 'تسليم الإيصالات'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .handover-card {
        background:#fff; border-radius:16px; border:1px solid #eef2f7;
        box-shadow:0 4px 25px rgba(0,0,0,.08); overflow:hidden;
    }
    .handover-header {
        background:linear-gradient(135deg,#667eea,#764ba2);
        color:#fff; padding:25px 30px;
    }
    .handover-header h3 { margin:0; font-weight:700; }
    .handover-header p  { margin:5px 0 0; opacity:.9; }

    .handover-body { padding:25px; }

    .search-box { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; }
    .search-box input {
        flex:1; min-width:180px; height:45px; border-radius:10px;
        border:2px solid #e8edf5; padding:0 15px; font-size:.9rem;
    }
    .search-box button {
        height:45px; padding:0 30px; border-radius:50px; border:none;
        background:linear-gradient(135deg,#667eea,#764ba2);
        color:#fff; font-weight:600; cursor:pointer;
    }

    .handover-table { width:100%; border-collapse:collapse; }
    .handover-table th {
        background:#1a1a2e; color:#fff; padding:12px;
        font-size:.78rem; text-transform:uppercase;
    }
    .handover-table td {
        padding:10px; text-align:center; border-bottom:1px solid #f1f3f8;
    }
    .handover-table tbody tr:hover { background:#f8faff; }

    .summary-bar {
        display:flex; justify-content:space-between; align-items:center;
        background:#f8faff; padding:18px 25px; border-radius:12px;
        margin-top:20px; flex-wrap:wrap; gap:15px;
    }
    .btn-surrender {
        padding:12px 35px; border-radius:50px; border:none;
        background:linear-gradient(135deg,#11998e,#38ef7d);
        color:#fff; font-weight:700; cursor:pointer;
    }
    .btn-surrender:disabled { opacity:.6; cursor:not-allowed; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <div class="handover-card">

        <div class="handover-header">
            <h3><i class="fas fa-hand-holding-usd me-2"></i> تسليم الإيصالات</h3>
            <p><i class="fas fa-info-circle me-1"></i> ابحث عن الإيصالات غير المسلّمة بواسطة نطاق الأرقام ثم أكّد التسليم</p>
        </div>

        <div class="handover-body">

            
            <div class="search-box">
                <input type="text" id="receiptFrom" placeholder="من رقم الوصل..." />
                <input type="text" id="receiptTo"   placeholder="إلى رقم الوصل..." />
                <button id="btnSearch">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>

            <div id="resultsWrapper" style="display:none;">
                <div style="overflow-x:auto;">
                    <table class="handover-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>رقم الوصل</th>
                                <th>الطالب</th>
                                <th>الدورة</th>
                                <th>المبلغ</th>
                                <th>تاريخ التحصيل</th>
                                <th>أُدخل بواسطة</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody"></tbody>
                    </table>
                </div>

                <div class="summary-bar">
                    <div>
                        <strong>عدد الإيصالات المحددة: <span id="selectedCount">0</span></strong>
                        &nbsp;|&nbsp;
                        <strong>الإجمالي: <span id="selectedTotal">0</span> ج.م</strong>
                    </div>
                    <div>
                        <button class="btn-surrender" id="btnSurrender" disabled>
                            <i class="fas fa-check"></i> تأكيد التسليم
                        </button>
                    </div>
                </div>
            </div>

            <div id="emptyState" style="text-align:center; padding:50px; color:#adb5bd;">
                <i class="fas fa-inbox" style="font-size:3rem; display:block; margin-bottom:10px;"></i>
                لم يتم البحث بعد
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    var results       = [];
    var resultsWrapper = document.getElementById('resultsWrapper');
    var emptyState     = document.getElementById('emptyState');
    var resultsBody    = document.getElementById('resultsBody');
    var btnSearch      = document.getElementById('btnSearch');
    var btnSurrender   = document.getElementById('btnSurrender');

    btnSearch.addEventListener('click', function () {
        var from = document.getElementById('receiptFrom').value.trim();
        var to   = document.getElementById('receiptTo').value.trim();

        if (!from || !to) {
            alert('يرجى تحديد نطاق الأرقام');
            return;
        }

        fetch("<?php echo e(route('payments.handover.search')); ?>?receipt_from=" + encodeURIComponent(from) + "&receipt_to=" + encodeURIComponent(to), {
            headers: { 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            results = data.payments || [];
            renderResults();
        })
        .catch(err => console.error(err));
    });

    function renderResults() {
        emptyState.style.display = 'none';

        if (results.length === 0) {
            resultsWrapper.style.display = 'none';
            emptyState.style.display = 'block';
            emptyState.innerHTML = '<i class="fas fa-info-circle" style="font-size:3rem; display:block; margin-bottom:10px;"></i> لا توجد إيصالات في هذا النطاق';
            return;
        }

        resultsBody.innerHTML = '';

        results.forEach(p => {
            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="checkbox" class="chk-row" value="${p.id}"></td>
                <td><strong style="color:#667eea;">${p.receipt_number}</strong></td>
                <td>${p.student ? p.student.fullname : '—'}</td>
                <td>${p.course ? p.course.subject_name : '—'}</td>
                <td><strong>${Number(p.payment_value).toLocaleString()} ج.م</strong></td>
                <td>${p.collected_at ? p.collected_at.substring(0,10) : '—'}</td>
                <td>${p.entered_by ? p.entered_by.name : '—'}</td>
            `;
            resultsBody.appendChild(tr);
        });

        resultsWrapper.style.display = 'block';

        // bind row checkboxes
        document.querySelectorAll('.chk-row').forEach(cb =>
            cb.addEventListener('change', updateSummary));

        document.getElementById('checkAll').addEventListener('change', function () {
            document.querySelectorAll('.chk-row').forEach(cb => cb.checked = this.checked);
            updateSummary();
        });

        updateSummary();
    }

    function updateSummary() {
        var selected = Array.from(document.querySelectorAll('.chk-row:checked'));
        document.getElementById('selectedCount').textContent = selected.length;

        var total = selected.reduce(function (sum, cb) {
            var p = results.find(x => x.id == cb.value);
            return sum + (p ? parseFloat(p.payment_value) : 0);
        }, 0);

        document.getElementById('selectedTotal').textContent = total.toLocaleString();
        btnSurrender.disabled = selected.length === 0;
    }

    btnSurrender.addEventListener('click', function () {
        var ids = Array.from(document.querySelectorAll('.chk-row:checked')).map(cb => cb.value);

        if (!confirm('هل أنت متأكد من تسليم ' + ids.length + ' إيصالاً؟')) return;

        btnSurrender.disabled = true;
        btnSurrender.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التسليم...';

        fetch("<?php echo e(route('payments.handover.surrender')); ?>", {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
                'Accept':'application/json'
            },
            body: JSON.stringify({ payment_ids: ids })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
                btnSurrender.disabled = false;
                btnSurrender.innerHTML = '<i class="fas fa-check"></i> تأكيد التسليم';
            }
        })
        .catch(err => {
            console.error(err);
            btnSurrender.disabled = false;
            btnSurrender.innerHTML = '<i class="fas fa-check"></i> تأكيد التسليم';
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/payments/handover.blade.php ENDPATH**/ ?>