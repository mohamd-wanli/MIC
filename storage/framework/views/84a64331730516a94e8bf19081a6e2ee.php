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
                        <strong>الإجمالي: <span id="selectedTotal">0</span> ل.س</strong>
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

    var results        = [];
    var resultsWrapper = document.getElementById('resultsWrapper');
    var emptyState     = document.getElementById('emptyState');
    var resultsBody    = document.getElementById('resultsBody');
    var btnSearch      = document.getElementById('btnSearch');
    var btnSurrender   = document.getElementById('btnSurrender');
    var fromInput      = document.getElementById('receiptFrom');
    var toInput        = document.getElementById('receiptTo');

    // ============================================
    // SEARCH
    // ============================================
    function runSearch() {
        var from = fromInput.value.trim();
        var to   = toInput.value.trim();

        if (!from && !to) {
            showToast('يرجى إدخال رقم واحد على الأقل', 'warning');
            return;
        }

        // Show loading state
        btnSearch.disabled = true;
        btnSearch.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري البحث...';

        emptyState.style.display = 'block';
        emptyState.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size:3rem; display:block; margin-bottom:10px;"></i> جاري تحميل النتائج...';
        resultsWrapper.style.display = 'none';

        var params = new URLSearchParams();
        if (from) params.append('receipt_from', from);
        if (to)   params.append('receipt_to', to);

        fetch("<?php echo e(route('payments.handover.search')); ?>?" + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) {
                showToast(data.message || 'حدث خطأ', 'danger');
                results = [];
                renderResults(true);
                return;
            }
            results = data.payments || [];
            renderResults(false);
        })
        .catch(err => {
            console.error(err);
            showToast('فشل البحث، حاول مرة أخرى', 'danger');
            results = [];
            renderResults(true);
        })
        .finally(() => {
            btnSearch.disabled = false;
            btnSearch.innerHTML = '<i class="fas fa-search"></i> بحث';
        });
    }

    // ============================================
    // ENTER KEY SUBMIT
    // ============================================
    fromInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') runSearch();
    });
    toInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') runSearch();
    });

    btnSearch.addEventListener('click', runSearch);

    // ============================================
    // RENDER RESULTS
    // ============================================
    function renderResults(isError) {
        if (results.length === 0) {
            resultsWrapper.style.display = 'none';
            emptyState.style.display = 'block';
            emptyState.innerHTML = isError
                ? '<i class="fas fa-exclamation-triangle" style="font-size:3rem; display:block; margin-bottom:10px; color:#f7971e;"></i> حدث خطأ أثناء البحث'
                : '<i class="fas fa-info-circle" style="font-size:3rem; display:block; margin-bottom:10px;"></i> لا توجد إيصالات في هذا النطاق';
            return;
        }

        emptyState.style.display = 'none';
        resultsBody.innerHTML = '';

        results.forEach(function (p) {
            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="checkbox" class="chk-row" value="${p.id}"></td>
                <td><strong style="color:#667eea;">${p.receipt_number ?? '—'}</strong></td>
                <td>${p.student ? p.student.fullname : '—'}</td>
                <td>${p.course ? p.course.subject_name : '—'}</td>
                <td><strong>${Number(p.payment_value).toLocaleString()} ل.س</strong></td>
                <td>${p.collected_at ? p.collected_at.substring(0,10) : '—'}</td>
                <td>${p.entered_by ? p.entered_by.name : '—'}</td>
            `;
            resultsBody.appendChild(tr);
        });

        resultsWrapper.style.display = 'block';

        document.querySelectorAll('.chk-row').forEach(function (cb) {
            cb.addEventListener('change', updateSummary);
        });

        // Reset checkAll
        var checkAll = document.getElementById('checkAll');
        checkAll.checked = false;
        checkAll.addEventListener('change', function () {
            document.querySelectorAll('.chk-row').forEach(cb => cb.checked = this.checked);
            updateSummary();
        });

        updateSummary();
    }

    // ============================================
    // UPDATE SUMMARY
    // ============================================
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

    // ============================================
    // SURRENDER
    // ============================================
    btnSurrender.addEventListener('click', function () {
        var ids = Array.from(document.querySelectorAll('.chk-row:checked')).map(cb => cb.value);

        if (!confirm('هل أنت متأكد من تسليم ' + ids.length + ' إيصالاً؟')) return;

        btnSurrender.disabled = true;
        btnSurrender.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التسليم...';

        fetch("<?php echo e(route('payments.handover.surrender')); ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ payment_ids: ids })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 900);
            } else {
                showToast(data.message, 'danger');
                btnSurrender.disabled = false;
                btnSurrender.innerHTML = '<i class="fas fa-check"></i> تأكيد التسليم';
            }
        })
        .catch(err => {
            console.error(err);
            showToast('فشل التسليم، حاول مرة أخرى', 'danger');
            btnSurrender.disabled = false;
            btnSurrender.innerHTML = '<i class="fas fa-check"></i> تأكيد التسليم';
        });
    });

    // ============================================
    // TOAST NOTIFICATION
    // ============================================
    function showToast(message, type) {
        var colors = {
            success: '#28a745',
            danger: '#dc3545',
            warning: '#ffc107',
        };
        var icons = {
            success: 'fa-check-circle',
            danger: 'fa-times-circle',
            warning: 'fa-exclamation-triangle',
        };

        var el = document.createElement('div');
        el.style.cssText = `
            position:fixed; top:20px; left:50%; transform:translateX(-50%);
            background:${colors[type] || '#333'}; color:#fff;
            padding:12px 24px; border-radius:50px; font-weight:600;
            box-shadow:0 6px 25px rgba(0,0,0,.2); z-index:9999;
            display:flex; align-items:center; gap:10px; font-size:.9rem;
            opacity:0; transition:opacity .3s;
        `;
        el.innerHTML = `<i class="fas ${icons[type] || 'fa-info-circle'}"></i> ${message}`;
        document.body.appendChild(el);

        setTimeout(() => el.style.opacity = '1', 10);
        setTimeout(() => {
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);
        }, 2500);
    }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/payments/handover.blade.php ENDPATH**/ ?>