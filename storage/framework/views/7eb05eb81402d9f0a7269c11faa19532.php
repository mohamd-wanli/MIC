<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>كشف حضور دورة</title>
<style>
  * { box-sizing: border-box; }
  body {
    font-family: "Calibri", "Tahoma", "Arial", sans-serif;
    background: #e9e9e9;
    margin: 0;
    padding: 20px;
  }
  .sheet {
    background: #fff;
    width: 1450px;
    margin: 0 auto;
    padding: 18px;
    border: 1px solid #999;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  /* Excel-style default gridlines: thin, light gray */
  td, th {
    border: 1px solid #b7b7b7;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    padding: 2px 3px;
    white-space: nowrap;
    background: #fff;
  }

  /* ===== Top meta bar ===== */
  .meta-table td {
    font-weight: bold;
    font-size: 13px;
    height: 30px;
    background: #f2f2f2;
    border: 1px solid #8c8c8c;
  }

  /* ===== Main grid ===== */
  .main-table { margin-top: 4px; }
  .main-table td, .main-table th {
    height: 24px;
    min-width: 22px;
    border: 1px solid #b7b7b7;
  }
  .main-table thead th {
    background: #dce6f1; /* excel-like header blue */
    font-weight: bold;
    border: 1px solid #8c8c8c;
  }
  .col-name { min-width: 110px; font-weight: bold; text-align: right; padding-right: 6px; }
  .col-id { min-width: 55px; font-weight: bold; }
  .col-lecnum { min-width: 20px; font-size: 10px; }

  /* Day header numbers: no vertical dividers between them, only a bottom rule */
  .col-day {
    min-width: 20px;
    font-size: 10px;
    border-top: 1px solid #8c8c8c;
    border-bottom: 1px solid #8c8c8c;
    border-left: none;
    border-right: none;
  }
  /* keep an outer frame around the whole day-number block */
  .col-day:first-child { border-right: 1px solid #8c8c8c; }
  .col-day:last-child { border-left: 1px solid #8c8c8c; }

  .vertical-text {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    font-size: 9px;
    height: 55px;
  }
  .small-label { font-size: 9px; }

  .sign-row td {
    height: 26px;
    background: #fafafa;
    font-weight: bold;
    font-size: 11px;
  }
  .sign-row .col-name {
    text-align: center;
  }

  .empty-row td { height: 26px; }

  /* ===== Bottom exam / signature area ===== */
  .bottom-table { margin-top: 0; }
  .bottom-table td {
    text-align: right;
    font-size: 12px;
    height: 30px;
    border: 1px solid #b7b7b7;
  }
  .label-cell { font-weight: bold; white-space: nowrap; }
  .filler-cell { border-left: none; border-right: none; }

  /* ===== Footer grid ===== */
  .footer-table { margin-top: 0; }
  .footer-table td {
    height: 45px;
    font-size: 12px;
    text-align: right;
    font-weight: bold;
    vertical-align: top;
    padding: 6px;
    border: 1px solid #b7b7b7;
  }

  .session-duration-wrap {
    display: flex;
    justify-content: flex-start; /* RTL: flex-start = right side */
    margin-top: 10px;
  }
  .session-duration-box {
    border: 1px solid #8c8c8c;
    background: #f2f2f2;
    font-weight: bold;
    font-size: 13px;
    padding: 5px 12px;
  }
</style>
</head>
<body>
<div class="sheet">

  <!-- ============ TOP META BAR ============ -->
  <table class="meta-table">
    <tr>
      <td style="width:9%;">رقم الدورة: <?php echo e($course->coursenumber); ?></td>
      <td style="width:22%;">اسم الدورة : <?php echo e($course->subject_name); ?><br></td>
      <td style="width:12%;">تاريخ البدء : <?php echo e($course->start_date); ?></td>
      <td style="width:9%;">رسم الدورة : <?php echo e($course->price); ?></td>
      <td style="width:9%;">الايام :<?php echo e($course->days_of_course); ?></td>
      <td style="width:9%;">التوقيت : <?php echo e($course->start_hour); ?></td>
      <td style="width:9%;">عدد الحصص :<?php echo e($course->num_of_session); ?></td>
    </tr>
  </table>

  <!-- ============ MAIN ATTENDANCE GRID ============ -->
  <table class="main-table">
    <colgroup>
      <col style="width:110px;">
      <col style="width:55px;">
      <col span="8" style="width:22px;">
      <col span="30" style="width:20px;">
    </colgroup>
    <thead>
      <tr>
        <th rowspan="2" class="col-name">اسم الطالب</th>
        <th rowspan="2" class="col-id">الرقم</th>
        <th colspan="8">رقم المحاضرة :</th>
        <th colspan="30">الأيام</th>
      </tr>
      <tr>
        <th class="vertical-text">دفعة1</th>
        <th class="vertical-text">دفعة2</th>
        <th class="vertical-text">دفعة3</th>
        
        <th class="col-lecnum"></th>
        <th class="col-lecnum"></th>
        <th class="col-lecnum"></th>
        <th class="col-lecnum"></th>
        <th class="col-lecnum"></th>

        <th class="col-day">1</th><th class="col-day">2</th><th class="col-day">3</th><th class="col-day">4</th>
        <th class="col-day">5</th><th class="col-day">6</th><th class="col-day">7</th><th class="col-day">8</th>
        <th class="col-day">9</th><th class="col-day">10</th><th class="col-day">11</th><th class="col-day">12</th>
        <th class="col-day">13</th><th class="col-day">14</th><th class="col-day">15</th><th class="col-day">16</th>
        <th class="col-day">17</th><th class="col-day">18</th><th class="col-day">19</th><th class="col-day">20</th>
        <th class="col-day">21</th><th class="col-day">22</th><th class="col-day">23</th><th class="col-day">24</th>
        <th class="col-day">25</th><th class="col-day">26</th><th class="col-day">27</th><th class="col-day">28</th>
        <th class="col-day">29</th><th class="col-day">30</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $course->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td class="col-name"><?php echo e($student->fullname); ?></td>
        <td class="col-id"><?php echo e($student->id); ?></td> 
        <td colspan="8"></td>
        <td colspan="30"></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      
      <tr class="sign-row">
        <td class="col-name" colspan="2">توقيع المدرس اليومي للحصص</td>
        <td colspan="8"></td>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>

      <tr class="empty-row">
        <td></td><td></td><td colspan="8"></td><td colspan="30"></td>
      </tr>
    </tbody>
  </table>

  <!-- ============ EXAM DATE / SIGNATURES SECTION ============ -->
  <table class="bottom-table">
    <colgroup>
      <col style="width:12%;">
      <col style="width:63%;">
      <col style="width:25%;">
    </colgroup>
    <tr>
      <td class="label-cell"></td>
      <td class="filler-cell" rowspan="3"></td>
      <td class="label-cell">تاريخ الامتحان :</td>
    </tr>
    <tr>
      <td class="label-cell">مدقق الأقساط والنتائج:<br>سمر ضاهر</td>
      <td class="label-cell">المدرس : بشرى رجب</td>
    </tr>
    <tr>
      <td class="label-cell">التوقيع :</td>
      <td class="label-cell">التوقيع :</td>
    </tr>
  </table>

  <!-- ============ FOOTER GRID ============ -->
  <table class="footer-table">
    <colgroup>
      <col style="width:22%;">
      <col style="width:45%;">
      <col style="width:33%;">
    </colgroup>
    <tr>
      <td>رئيس القسم :<br><br>التوقيع:</td>
      <td rowspan="2">ملاحظات :</td>
      <td rowspan="2">المدير المالي :</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td>المدقق المالي :</td>
      <td></td>
      <td>لجنة الامتحانات :</td>
    </tr>
  </table>

  <!-- ============ SESSION DURATION (calculated from start_hour / end_hour) ============ -->
  <?php
    $start = \Carbon\Carbon::parse($course->start_hour);
    $end = \Carbon\Carbon::parse($course->end_hour);

    // Compute from raw seconds and floor manually — diffInMinutes()/diffInHours()
    // can round the underlying float (e.g. 90 min -> 1.5h -> rounds to 2h) depending
    // on the Carbon version, so we avoid that entirely.
    $diffInSeconds = $end->diffInSeconds($start, true); // true = absolute value
    $totalMinutes  = intdiv($diffInSeconds, 60);
    $hours         = intdiv($totalMinutes, 60);
    $minutes       = $totalMinutes % 60;

    if ($hours > 0 && $minutes === 30) {
        $durationText = $hours . ' ساعة ونصف';
    } elseif ($hours > 0 && $minutes > 0) {
        $durationText = $hours . ' ساعة و ' . $minutes . ' دقيقة';
    } elseif ($hours > 0) {
        $durationText = $hours . ' ساعة';
    } else {
        $durationText = $minutes . ' دقيقة';
    }
  ?>
  <div class="session-duration-wrap">
    <div class="session-duration-box">
      مدة الجلسة : <?php echo e($durationText); ?>

    </div>
  </div>

</div>
</body>
</html>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/print/course_students.blade.php ENDPATH**/ ?>