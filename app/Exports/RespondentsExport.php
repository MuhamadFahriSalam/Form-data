<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RespondentsExport implements FromArray, ShouldAutoSize, WithStyles, WithEvents, WithTitle
{
    protected array $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function title(): string
    {
        return 'Respondents';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $totalRows = count($this->rows);
                $totalColumns = count($this->rows[0] ?? []);
                $lastColumn = $this->columnLetter($totalColumns);
                $lastCell = $lastColumn . $totalRows;

                if ($totalRows < 1 || $totalColumns < 1) {
                    return;
                }

                // Freeze header
                $sheet->freezePane('A2');

                // Auto filter
                $sheet->setAutoFilter("A1:{$lastColumn}1");

                // Border tabel
                $sheet->getStyle("A1:{$lastCell}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Alignment
                $sheet->getStyle("A1:{$lastCell}")
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // No rata tengah
                $sheet->getStyle("A2:A{$totalRows}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Waktu isi rata tengah
                $sheet->getStyle("{$lastColumn}2:{$lastColumn}{$totalRows}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Lebar kolom penting
                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(24);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension($lastColumn)->setWidth(20);
            },
        ];
    }

    protected function columnLetter(int $columnNumber): string
    {
        $letter = '';

        while ($columnNumber > 0) {
            $mod = ($columnNumber - 1) % 26;
            $letter = chr(65 + $mod) . $letter;
            $columnNumber = intdiv($columnNumber - $mod, 26);
        }

        return $letter;
    }
}