<?php

namespace App\Http\Controllers;

use App\Models\Detail_Report;
use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{
    function export(Request $request)
    {
        // Ambil data task, subtask, dan subsubtask
        $tasks = Task::with('subtasks.subtasks')->whereNull('task_idtasks')->get();

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header kolom
        $sheet->setCellValue('A1', 'Nama Task');
        $sheet->setCellValue('B1', 'Deskripsi Task');
        $sheet->setCellValue('C1', 'Parent Task');
        $sheet->setCellValue('D1', 'Nama Subtask');
        $sheet->setCellValue('E1', 'Deskripsi Subtask');
        $sheet->setCellValue('F1', 'Nama Subsubtask');
        $sheet->setCellValue('G1', 'Deskripsi Subsubtask');
        $sheet->setCellValue('H1', 'Laporan');

        // Memberikan style pada header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Menyesuaikan lebar kolom
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Menambahkan data tasks, subtasks, dan subsubtasks
        $row = 2;
        foreach ($tasks as $task) {
            // Menambahkan task utama
            $sheet->setCellValue('A' . $row, $task->name);
            $sheet->setCellValue('B' . $row, $task->description);

            // Tambahkan hyperlink laporan jika tersedia
            if ($task->reports->isNotEmpty()) {
                $taskUrl = 'http://127.0.0.1:8000/detailReport/' . $task->reports->first()->id;
                $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                $sheet->getCell('H' . $row)->getHyperlink()->setUrl($taskUrl);
                $sheet->getStyle('H' . $row)->getFont()->getColor()->setRGB('0000FF');
                $sheet->getStyle('H' . $row)->getFont()->setUnderline(true);
            } else {
                $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
            }

            $row++;

            // Menambahkan subtasks
            foreach ($task->subtasks as $subtask) {
                $sheet->setCellValue('C' . $row, $task->name);
                $sheet->setCellValue('D' . $row, $subtask->name);
                $sheet->setCellValue('E' . $row, $subtask->description);

                // Tambahkan hyperlink laporan jika tersedia
                if ($subtask->reports->isNotEmpty()) {
                    $subtaskUrl = 'http://127.0.0.1:8000/detailReport/' . $subtask->reports->first()->id;
                    $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                    $sheet->getCell('H' . $row)->getHyperlink()->setUrl($subtaskUrl);
                    $sheet->getStyle('H' . $row)->getFont()->getColor()->setRGB('0000FF');
                    $sheet->getStyle('H' . $row)->getFont()->setUnderline(true);
                } else {
                    $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
                }

                $row++;

                // Menambahkan subsubtasks
                foreach ($subtask->subtasks as $subsubtask) {
                    $sheet->setCellValue('C' . $row, $task->name);
                    $sheet->setCellValue('D' . $row, $subtask->name);
                    $sheet->setCellValue('F' . $row, $subsubtask->name);
                    $sheet->setCellValue('G' . $row, $subsubtask->description);

                    // Tambahkan hyperlink laporan jika tersedia
                    if ($subsubtask->reports->isNotEmpty()) {
                        $subsubtaskUrl = 'http://127.0.0.1:8000/detailReport/' . $subsubtask->reports->first()->id;
                        $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                        $sheet->getCell('H' . $row)->getHyperlink()->setUrl($subsubtaskUrl);
                        $sheet->getStyle('H' . $row)->getFont()->getColor()->setRGB('0000FF');
                        $sheet->getStyle('H' . $row)->getFont()->setUnderline(true);
                    } else {
                        $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
                    }

                    $row++;
                }
            }
        }

        // Menambahkan border pada seluruh data
        $sheet->getStyle('A1:H' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Menulis file Excel ke dalam output
        $writer = new Xlsx($spreadsheet);
        $filename = 'kegiatan.xlsx';

        // Mengirim file Excel ke browser untuk diunduh
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="kegiatan.xlsx"',
            ]
        );
    }
}

