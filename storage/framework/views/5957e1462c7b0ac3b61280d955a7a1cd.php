<style>
    .report-card { background:#fff; border-radius:16px; border:1px solid #eef2f7; box-shadow:0 4px 25px rgba(0,0,0,.08); overflow:hidden; }
    .report-header { background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; padding:25px 30px; }
    .report-header h3 { margin:0; font-weight:700; }
    .report-header p { margin:5px 0 0; opacity:.9; }
    .report-body { padding:25px; }
    .filter-bar { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:end; }
    .filter-bar label { font-size:.8rem; font-weight:600; color:#2d3436; display:block; margin-bottom:4px; }
    .filter-bar input, .filter-bar select { height:42px; border-radius:10px; border:2px solid #e8edf5; padding:0 12px; min-width:150px; }
    .btn-filter { height:42px; padding:0 25px; border-radius:50px; border:none; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; font-weight:600; cursor:pointer; }
    .btn-print { height:42px; padding:0 25px; border-radius:50px; border:none; background:linear-gradient(135deg,#11998e,#38ef7d); color:#fff; font-weight:600; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .summary-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:15px; margin-bottom:20px; }
    .summary-card { background:#f8faff; padding:18px; border-radius:12px; border:1px solid #eef2f7; text-align:center; }
    .summary-card .num { font-size:1.6rem; font-weight:700; color:#667eea; }
    .summary-card .lbl { color:#6c757d; font-size:.85rem; }
    .report-table { width:100%; border-collapse:collapse; }
    .report-table th { background:#1a1a2e; color:#fff; padding:12px; font-size:.78rem; text-align:center; text-transform:uppercase; }
    .report-table td { padding:10px; text-align:center; border-bottom:1px solid #f1f3f8; }
    .report-table tbody tr:hover { background:#f8faff; }
    .status-badge { padding:3px 12px; border-radius:50px; font-size:.75rem; font-weight:600; display:inline-block; }
    .status-badge.success { background:#d4edda; color:#155724; }
    .status-badge.warning { background:#fff3cd; color:#856404; }
    .status-badge.danger  { background:#f8d7da; color:#721c24; }
</style><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\payments\reports\_styles.blade.php ENDPATH**/ ?>