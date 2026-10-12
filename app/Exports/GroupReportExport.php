<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class GroupReportExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomStartCell,
    WithEvents
{
    protected $students;
    protected $groupNumber;
    private $rowNumber = 0;

    public function __construct($students, $groupNumber = null)
    {
        $this->students    = $students;
        $this->groupNumber = $groupNumber;
    }

    public function collection()
    {
        return $this->students;
    }

    /**
     * Start writing headings at row 5 (we use rows 1-4 for the Arabic header).
     */
    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array
    {
        return [
            'م',
            'الاسم الثلاثي',
            'اسم الأب',
            'اسم الأم',
            'محل وتاريخ الولادة',
            'الجنسية',
            'الرقم الوطني',
            'اسم الدورة',
            'تاريخ البداية',
            'تاريخ النهاية',
            'اسم المدرب',
            'رقم الشهادة',
            'رقم الصفحة',
            'الملاحظة',
        ];
    }

    public function map($s): array
    {
        return [
            ++$this->rowNumber,
            $s->fullname        ?? '',
            $s->fathername      ?? '',
            $s->mothername      ?? '',
            $s->date_of_birth   ?? '',
            $s->nationality     ?? '',
            $s->national_number ?? '',
            $s->subject_name    ?? '',
            $s->start_date      ?? '',
            $s->end_date        ?? '',
            $s->teacherName     ?? '',
            $s->certificate_number ?? '',
            $s->page_number     ?? '',
            $s->notes           ?? '',
        ];
    }

    /**
     * Add the Arabic title rows above the table and style the sheet.
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet       = $event->sheet->getDelegate();
                $lastColumn  = 'N'; // 14 columns A..N
                $headerRow   = 5;
                $dataStart   = 6;
                $dataEnd     = $dataStart + count($this->students) - 1;

                // ---------- Title rows ----------
                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->setCellValue('A1', 'مركز المأمون الدولي للتدريب على الحرف والمهن');

                $sheet->mergeCells("A2:{$lastColumn}2");
                $sheet->setCellValue('A2', 'الاتحاد العام للحرفيين - الجمعية الحرفية لمراكز التدريب المهني والحرفي بدمشق وريفها');

                $sheet->mergeCells("A3:{$lastColumn}3");
                $sheet->setCellValue('A3', 'تقرير مجموعة رقم: ' . ($this->groupNumber ?? '—'));

                // ---------- RTL ----------
                $sheet->setRightToLeft(true);

                // ---------- Title styling ----------
                foreach (['A1', 'A2', 'A3'] as $cell) {
                    $sheet->getStyle($cell)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle($cell)->getFont()->setBold(true);
                }
                $sheet->getStyle('A1')->getFont()->setSize(16);
                $sheet->getStyle('A2')->getFont()->setSize(12);
                $sheet->getStyle('A3')->getFont()->setSize(12);
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->getRowDimension(2)->setRowHeight(22);
                $sheet->getRowDimension(3)->setRowHeight(22);
                $sheet->getRowDimension(4)->setRowHeight(8); // spacer

                // ---------- Header row styling ----------
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")->applyFromArray([
                    'font' => [
                        'bold'  => true,
                        'color' => ['rgb' => 'FFFFFF'],
                        'size'  => 12,
                    ],
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1A1A2E'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color'       => ['rgb' => '000000'],
                        ],
                    ],
                ]);
                $sheet->getRowDimension($headerRow)->setRowHeight(28);

                // ---------- Data rows styling ----------
                if ($dataEnd >= $dataStart) {
                    $sheet->getStyle("A{$dataStart}:{$lastColumn}{$dataEnd}")->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical'   => Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color'       => ['rgb' => '9AA3B3'],
                            ],
                        ],
                    ]);
                }

                // ---------- Column widths ----------
                $widths = [
                    'A' => 6,   // م
                    'B' => 30,  // الاسم الثلاثي
                    'C' => 18,  // اسم الأب
                    'D' => 18,  // اسم الأم
                    'E' => 22,  // محل وتاريخ الولادة
                    'F' => 14,  // الجنسية
                    'G' => 20,  // الرقم الوطني
                    'H' => 26,  // اسم الدورة
                    'I' => 14,  // تاريخ البداية
                    'J' => 14,  // تاريخ النهاية
                    'K' => 22,  // اسم المدرب
                    'L' => 14,  // رقم الشهادة
                    'M' => 12,  // رقم الصفحة
                    'N' => 20,  // الملاحظة
                ];
                foreach ($widths as $col => $width) {
                    $sheet->getColumnDimension($col)->setWidth($width);
                }

                // ---------- Page setup ----------
                $sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);
                $sheet->getPageMargins()->setTop(0.4);
                $sheet->getPageMargins()->setBottom(0.4);
                $sheet->getPageMargins()->setLeft(0.3);
                $sheet->getPageMargins()->setRight(0.3);

                // Repeat header row on every printed page
                $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd($headerRow, $headerRow);
            },
        ];
    }
}
