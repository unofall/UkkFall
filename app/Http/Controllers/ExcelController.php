<?php

namespace App\Http\Controllers;

use App\Models\Detail_Report;
use App\Models\Task;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{
    function export(Request $request){
        // Ambil data task, subtask, dan subsubtask
        $tasks = Task::with('subtasks.subtasks')->whereNull('task_idtasks')->get();
        $report = Detail_Report::where('id', $request->task_id)->get();


        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('A1', 'Nama Task');
        $sheet->setCellValue('B1', 'Deskripsi Task');
        $sheet->setCellValue('C1', 'Parent Task');
        $sheet->setCellValue('D1', 'Nama Subtask');
        $sheet->setCellValue('E1', 'Deskripsi Subtask');
        $sheet->setCellValue('F1', 'Nama Subsubtask');
        $sheet->setCellValue('G1', 'Deskripsi Subsubtask');
        // $sheet->setCellValue('F1', 'Link Laporan');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
                'name' => 'Arial',
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'],
            ],
        ];

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Menambahkan data tasks, subtasks, dan subsubtasks
        $row = 2;

        // foreach ($tasks as $task) {
        //     // Menambahkan task utama
        //     $sheet->setCellValue('A' . $row, $task->name);
        //     $sheet->setCellValue('B' . $row, $task->description);
        //     $sheet->setCellValue('C' . $row, null);
        //     $sheet->setCellValue('D' . $row, null);
        //     $sheet->setCellValue('E' . $row, null);
        //     $sheet->setCellValue('F' . $row, null);
        //     $sheet->setCellValue('G' . $row, null);

        //     // Hyperlink untuk task utama
        //     $taskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $task->id;
        //     $sheet->setCellValue('H' . $row, 'Lihat Laporan');
        //     $sheet
        //         ->getCell('H' . $row)
        //         ->getHyperlink()
        //         ->setUrl($taskUrl);
        //     $sheet
        //         ->getStyle('H' . $row)
        //         ->getFont()
        //         ->getColor()
        //         ->setRGB('0000FF'); // Warna biru
        //     $sheet
        //         ->getStyle('H' . $row)
        //         ->getFont()
        //         ->setUnderline(true);

        //     $row++;

        //     // Menambahkan subtasks
        //     foreach ($task->subtasks as $subtask) {
        //         $sheet->setCellValue('A' . $row, $subtask->name);
        //         $sheet->setCellValue('B' . $row, $subtask->description);
        //         $sheet->setCellValue('C' . $row, $task->name); // Parent Task
        //         $sheet->setCellValue('D' . $row, $subtask->name);
        //         $sheet->setCellValue('E' . $row, $subtask->description);
        //         $sheet->setCellValue('F' . $row, null);
        //         $sheet->setCellValue('G' . $row, null);

        //         // Hyperlink untuk subtask
        //         $subtaskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $subtask->id;
        //         $sheet->setCellValue('H' . $row, 'Lihat Laporan');
        //         $sheet
        //             ->getCell('H' . $row)
        //             ->getHyperlink()
        //             ->setUrl($subtaskUrl);
        //         $sheet
        //             ->getStyle('H' . $row)
        //             ->getFont()
        //             ->getColor()
        //             ->setRGB('0000FF'); // Warna biru
        //         $sheet
        //             ->getStyle('H' . $row)
        //             ->getFont()
        //             ->setUnderline(true);

        //         $row++;

        //         // Menambahkan subsubtasks
        //         foreach ($subtask->subtasks as $subsubtask) {
        //             $sheet->setCellValue('A' . $row, $subsubtask->name);
        //             $sheet->setCellValue('B' . $row, $subsubtask->description);
        //             $sheet->setCellValue('C' . $row, $task->name); // Parent Task
        //             $sheet->setCellValue('D' . $row, $subtask->name); // Subtask
        //             $sheet->setCellValue('E' . $row, $subtask->description);
        //             $sheet->setCellValue('F' . $row, $subsubtask->name);
        //             $sheet->setCellValue('G' . $row, $subsubtask->description);

        //             // Hyperlink untuk subsubtask
        //             $subsubtaskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $subsubtask->id;
        //             $sheet->setCellValue('H' . $row, 'Lihat Laporan');
        //             $sheet
        //                 ->getCell('H' . $row)
        //                 ->getHyperlink()
        //                 ->setUrl($subsubtaskUrl);
        //             $sheet
        //                 ->getStyle('H' . $row)
        //                 ->getFont()
        //                 ->getColor()
        //                 ->setRGB('0000FF'); // Warna biru
        //             $sheet
        //                 ->getStyle('H' . $row)
        //                 ->getFont()
        //                 ->setUnderline(true);

        //             $row++;
        //         }
        //     }
        // }

        foreach ($tasks as $task) {
            // Menambahkan task utama
            $sheet->setCellValue('A' . $row, $task->name);
            $sheet->setCellValue('B' . $row, $task->description);
            $sheet->setCellValue('C' . $row, null);
            $sheet->setCellValue('D' . $row, null);
            $sheet->setCellValue('E' . $row, null);
            $sheet->setCellValue('F' . $row, null);
            $sheet->setCellValue('G' . $row, null);

            // Cek apakah task memiliki laporan
            if ($task->reports->isNotEmpty()) {
                $taskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $task->reports->first()->id;
                $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                $sheet
                    ->getCell('H' . $row)
                    ->getHyperlink()
                    ->setUrl($taskUrl);
                $sheet
                    ->getStyle('H' . $row)
                    ->getFont()
                    ->getColor()
                    ->setRGB('0000FF'); // Warna biru
                $sheet
                    ->getStyle('H' . $row)
                    ->getFont()
                    ->setUnderline(true);
            } else {
                $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
            }

            $row++;

            // Menambahkan subtasks
            foreach ($task->subtasks as $subtask) {
                $sheet->setCellValue('A' . $row, $subtask->name);
                $sheet->setCellValue('B' . $row, $subtask->description);
                $sheet->setCellValue('C' . $row, $task->name); // Parent Task
                $sheet->setCellValue('D' . $row, $subtask->name);
                $sheet->setCellValue('E' . $row, $subtask->description);
                $sheet->setCellValue('F' . $row, null);
                $sheet->setCellValue('G' . $row, null);

                // Cek apakah subtask memiliki laporan
                if ($subtask->reports->isNotEmpty()) {
                    $subtaskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $subtask->reports->first()->id;
                    $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                    $sheet
                        ->getCell('H' . $row)
                        ->getHyperlink()
                        ->setUrl($subtaskUrl);
                    $sheet
                        ->getStyle('H' . $row)
                        ->getFont()
                        ->getColor()
                        ->setRGB('0000FF'); // Warna biru
                    $sheet
                        ->getStyle('H' . $row)
                        ->getFont()
                        ->setUnderline(true);
                } else {
                    $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
                }

                $row++;

                // Menambahkan subsubtasks
                foreach ($subtask->subtasks as $subsubtask) {
                    $sheet->setCellValue('A' . $row, $subsubtask->name);
                    $sheet->setCellValue('B' . $row, $subsubtask->description);
                    $sheet->setCellValue('C' . $row, $task->name); // Parent Task
                    $sheet->setCellValue('D' . $row, $subtask->name); // Subtask
                    $sheet->setCellValue('E' . $row, $subtask->description);
                    $sheet->setCellValue('F' . $row, $subsubtask->name);
                    $sheet->setCellValue('G' . $row, $subsubtask->description);

                    // Cek apakah subsubtask memiliki laporan
                    if ($subsubtask->reports->isNotEmpty()) {
                        $subsubtaskUrl = 'http://127.0.0.1:8000/reports/detail-reports/' . $subsubtask->reports->first()->id;
                        $sheet->setCellValue('H' . $row, 'Lihat Laporan');
                        $sheet
                            ->getCell('H' . $row)
                            ->getHyperlink()
                            ->setUrl($subsubtaskUrl);
                        $sheet
                            ->getStyle('H' . $row)
                            ->getFont()
                            ->getColor()
                            ->setRGB('0000FF'); // Warna biru
                        $sheet
                            ->getStyle('H' . $row)
                            ->getFont()
                            ->setUnderline(true);
                    } else {
                        $sheet->setCellValue('H' . $row, 'Belum Ada Laporan');
                    }

                    $row++;
                }
            }
        }

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
            ],
        );
    }
}
