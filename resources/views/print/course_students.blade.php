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
    border: 1px solid #555555;
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
    border: 1px solid #333333;
  }

  /* ===== Main grid ===== */
  .main-table { margin-top: 4px; }
  .main-table td, .main-table th {
    height: 24px;
    min-width: 22px;
    border: 1px solid #555555;
  }
  .main-table thead th {
    background: #dce6f1; /* excel-like header blue */
    font-weight: bold;
    border: 1px solid #333333;
  }
  .col-name { min-width: 110px; font-weight: bold; text-align: right; padding-right: 6px; }
  .col-id { min-width: 55px; font-weight: bold; }
  .col-lecnum { min-width: 20px; font-size: 10px; }

  /* Day header numbers: each number now gets its own vertical divider */
  .col-day {
    min-width: 32px;          /* wider to match date cells */
    font-size: 10px;
    border-top: 1px solid #333333;
    border-bottom: 1px solid #333333;
    border-left: 1px solid #555555;
    border-right: 1px solid #555555;
  }
  /* keep a slightly stronger outer frame around the whole day-number block */
  .col-day:first-child { border-right: 1px solid #333333; }
  .col-day:last-child { border-left: 1px solid #333333; }

  /* ===== Date row (writable cells with a middle line) ===== */
  .date-row .date-label {
    font-weight: bold;
    border: 1px solid #333333;
  }
  .date-cell {
    min-width: 32px;          /* wider */
     height: 60px !important;           /* taller */
    font-size: 11px;
    font-weight: normal;
    background: #fff;
    padding: 1px 2px;         /* tighter padding for more writing space */
    border-top: 1px solid #333333;
    border-bottom: 1px solid #555555;
    border-left: 1px solid #555555;
    border-right: 1px solid #555555;
    position: relative;       /* needed for the middle line */
  }
  /* the horizontal line that splits each date cell into two */
  .date-cell::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    border-top: 1px solid #555555;
    pointer-events: none;
  }

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
    border: 1px solid #555555;
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
    border: 1px solid #555555;
  }

  .session-duration-wrap {
    display: flex;
    justify-content: flex-start; /* RTL: flex-start = right side */
    margin-top: 10px;
  }
  .session-duration-box {
    border: 1px solid #333333;
    background: #f2f2f2;
    font-weight: bold;
    font-size: 13px;
    padding: 5px 12px;
  }
  .grade{ min-width: 110px; font-weight: bold; text-align: right; padding-right: 6px; }

  /* Force browsers to actually print background colors */
  * {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    color-adjust: exact !important;
  }
  @media print {
    body {
        background: #fff !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .sheet {
        width: 100% !important;
        margin: 0 !important;
        padding: 5px !important;
        border: none !important;
        box-shadow: none !important;
    }
    .no-print {
        display: none !important;
    }
    @page {
        size: A4 landscape;
        margin: 8mm;
    }
    table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    thead {
        display: table-header-group; /* repeat header on each page */
    }
    .session-duration-wrap {
        page-break-inside: avoid;
    }
}
</style>
</head>
<body>
    <div class="no-print" style="text-align:center; margin-bottom:15px;">
    <button onclick="window.print()" style="
        background: linear-gradient(135deg, #667eea, #764ba2);
        color:#fff; border:none; padding:10px 30px;
        border-radius:50px; font-size:14px; font-weight:600;
        cursor:pointer; box-shadow:0 4px 15px rgba(102,126,234,0.3);
    ">
        🖨️ طباعة
    </button>
    <button onclick="window.close()" style="
        background:#e9e9e9; color:#333; border:none; padding:10px 30px;
        border-radius:50px; font-size:14px; font-weight:600;
        cursor:pointer; margin-right:10px;
    ">
        ✖ إغلاق
    </button>
</div>
<div class="sheet">

  <!-- ============ TOP META BAR ============ -->
  <table class="meta-table">
    <tr>
      <td style="width:9%;">رقم الدورة: {{$course->coursenumber}}</td>
      <td style="width:22%;">اسم الدورة : {{$course->subject_name}}<br></td>
      <td style="width:12%;">تاريخ البدء : {{$course->start_date}}</td>
      <td style="width:9%;">رسم الدورة : {{$course->price}}</td>
      <td style="width:9%;">الايام :{{$course->days_of_course}}</td>
      <td style="width:9%;">التوقيت : {{$course->start_hour}}</td>
      <td style="width:9%;">عدد الحصص :{{$course->num_of_session}}</td>
    </tr>
  </table>

  <!-- ============ MAIN ATTENDANCE GRID ============ -->
  <table class="main-table">
    <colgroup>
      <col style="width:110px;">
      <col style="width:55px;">
      <col span="4" style="width:22px;">
      <col span="30" style="width:32px;">  <!-- wider day columns -->
    </colgroup>
    <thead>
      <!-- ===== ROW 1 : date row with split cells ===== -->
      <tr class="date-row">
        <th rowspan="2" class="col-name">اسم الطالب</th>
        <th rowspan="2" class="col-id">الرقم</th>
        <th colspan="4" class="date-label">التاريخ:</th>

        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>
        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>
        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>
        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>
        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>
        <th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th><th class="date-cell"></th>

        <th rowspan="2" class="grade" style="width:10px;">التقدير</th>
      </tr>

      <!-- ===== ROW 2 : lecture numbers ===== -->
      <tr>
        <th class="vertical-text">دفعة1</th>
        <th class="vertical-text">دفعة2</th>
        <th class="vertical-text">دفعة3</th>
        {{-- single remaining lecture-number column --}}
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
      @foreach($course->students as $student)
      <tr>
        <td class="col-name">{{ $student->fullname }}</td>
        <td class="col-id">{{ $student->id }}</td>
         <td></td><td></td><td></td><td></td>

        {{-- 30 day columns --}}
        @for($d = 0; $d < 30; $d++)<td></td>@endfor
        {{-- grade column --}}
        <td></td>
      </tr>
      @endforeach

      {{-- Teacher's daily attendance sign-off row --}}
      <tr class="sign-row">
        <td class="col-name" colspan="2">توقيع المدرس اليومي للحصص</td>
        <td></td><td></td><td></td><td></td>

        @for($d = 0; $d < 30; $d++)<td></td>@endfor
        <td></td>
      </tr>

      <tr class="empty-row">
        <td></td><td></td>
         <td></td><td></td><td></td><td></td>

        @for($d = 0; $d < 30; $d++)<td></td>@endfor
        <td></td>
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
      <td class="label-cell">مدقق الأقساط والنتائج:<br></td>
      <td class="label-cell">المدرس : </td>
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

  <!-- ============ SESSION DURATION ============ -->
  @php
    $start = \Carbon\Carbon::parse($course->start_hour);
    $end = \Carbon\Carbon::parse($course->end_hour);

    $diffInSeconds = $end->diffInSeconds($start, true);
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
  @endphp
  <div class="session-duration-wrap">
    <div class="session-duration-box">
      مدة الجلسة : {{ $durationText }}
    </div>
  </div>

</div>
</body>
</html>
