<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Carbon\Carbon;

class CertificationExport implements FromArray, WithCustomStartCell
{
    protected Collection $students;
    protected array $courseInfo;

    public function __construct(Collection $students, array $courseInfo = [])
    {
        $this->students   = $students;
        $this->courseInfo = $courseInfo;
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function array(): array
    {
        $rows = [];

        $grouped    = $this->students->groupBy('page_number')->sortKeys();
        $totalPages = $grouped->count();
        $pageIndex  = 0;

        $emptyRow = array_fill(0, 13, '');

        foreach ($grouped as $pageNumber => $studentsInPage) {

            $pageIndex++;

            $rows[] = [
                'المحافظة',
                'اسم المركز',
                'اسم الدورة',
                'رقم الصفحة',
                'الاسم والشهرة',
                'اسم الأب',
                'اسم الأم',
                'تاريخ الميلاد',
                'الرقم الوطني',
                'الجنسية',
                'بداية الدورة',
                'نهاية الدورة',
                'هل الشهادة مطلوبة',
            ];

            foreach ($studentsInPage as $student) {


                $fullname = trim(($student->firstname ?? '') . ' ' . ($student->lastname ?? ''));


                $birth = $student->birth_date ?? null;
                $eligible = 'لا';
                if ($birth) {
                    try {
                        $eligible = Carbon::parse($birth)->age >= 15 ? 'نعم' : 'لا';
                    } catch (\Exception $e) {
                        $eligible = 'لا';
                    }
                }

                $rows[] = [
                    'دمشق',
                    'مركز المأمون',
                    $student->course_name,
                    $student->page_number,
                    $fullname,
                    $student->fathername ?? '',
                    $student->mothername ?? '',
                    $student->date_of_birth ?? '',
                    (string) ($student->national_number ?? ''),
                    $student->nationality ?? '',
                    $student->start_date ?? '',
                    $student->end_date ?? '',
                    $eligible,
                ];
            }

            if ($pageIndex < $totalPages) {
                $rows[] = $emptyRow;
                $rows[] = $emptyRow;
                $rows[] = $emptyRow;
                $rows[] = ['العام : 2026'];
            }
        }

        return $rows;
    }
}
