<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة تقرير الطلاب</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>تقرير الطلاب</h2>

    <table>
        <thead>
            <tr>
                <th>المعرف</th>
                <th>رقم بطاقة المهارات</th>
                <th>الاسم الكامل</th>
                <th>الاسم الأول إنجليزي</th>
                <th>الاسم الأب إنجليزي</th>
                <th>الاسم الجد إنجليزي</th>
                <th>الكنية إنجليزي</th>
                <th>اسم المادة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $key => $student)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $student->Nscn }} {{ $student->Lscn }}</td>
                    <td>{{ $student->fullname }}</td>
                    <td>{{ $student->english_firstname }}</td>
                    <td>{{ $student->english_fathername }}</td>
                    <td>{{ $student->english_grandfathername }}</td>
                    <td>{{ $student->english_lastname }}</td>
                    <td>{{ $student->meter }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="print-btn" onclick="window.print()">طباعة</button>

</body>
</html>
