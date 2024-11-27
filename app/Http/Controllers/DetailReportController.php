<?php

namespace App\Http\Controllers;

use App\Models\Detail_Report;
use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailReportController extends Controller
{
    //
    function show()
    {
        $details = Detail_Report::paginate(10);
        return view('report.detail-report', compact('details'));
    }

    function add(Request $request)
    {
        $data['report'] = Report::where('id', $request->id)->first();
        return view('report.add-detail-report', $data);
    }
    function create(Request $request)
    {
        $detail = $request->validate([
            'description' => ['required'],
            'datetime' => ['required', 'date'],
            'link_file' => ['nullable'],
            'file_upload' => ['nullable', 'file', 'mimes:png,jpg,pdf'],
            'reports_id' => ['required'],
        ]);

        if ($detail) {
            // Tentukan persentase berdasarkan input
            $percentage = 50; // Default: 50% jika semua kosong
            if ($request->link_file || $request->hasFile('file_upload')) {
                $percentage = 100; // 100% jika salah satu terisi
            }

            // Simpan file jika diunggah
            $filePath = null;
            if ($request->hasFile('file_upload')) {
                $filePath = $request->file('file_upload')->store('uploads', 'public'); // Simpan di folder 'storage/app/public/uploads'
            }

            // Simpan detail report
            Detail_Report::create([
                'description' => $request->description,
                'datetime' => $request->datetime,
                'link_file' => $request->link_file,
                'file_upload' => $filePath,
                'percentage' => $percentage,
                'reports_id' => $request->reports_id,
            ]);

            // Update kolom percentage di tabel reports
            // $report = Report::find($request->reports_id);
            // if ($report) {
            //     $report->update(['percentage' => $percentage]);
            // }

            // Update kolom percentage di tabel tasks (terkait laporan)
            // if ($report && $report->tasks_id) { // Pastikan laporan memiliki tasks_id
            //     $task = Task::find($report->tasks_id);
            //     if ($task) {
            //         $task->update(['percentage' => $percentage]);
            //     }
            // }

            if (Auth::user()->level === 'Admin') {
                return redirect('/detailReport')->with('Sukses', 'Detail Report Berhasil Ditambahkan');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/detailReport')->with('Sukses', 'Detail Report Berhasil Ditambahkan');

            }
        }
            return redirect()->back()->with('Error', 'Data Tidak Lengkap');
    }


    function edit(Request $request)
    {
        $data['detail'] = Detail_Report::find($request->id);
        $data['report'] = Report::where('id', $request->id)->first();
        return view('report.edit-detail-report', $data);
    }

    function update(Request $request)
    {
    $detail = $request->validate([
        'description' => ['required'],
        'datetime' => ['required', 'date'],
        'link_file' => ['nullable'], // Diubah menjadi nullable
        'file_upload' => ['nullable', 'file', 'mimes:png,jpg,pdf'],
        'reports_id' => ['required'],
    ]);

    if ($detail) {
        // Ambil detail report lama untuk membandingkan
        $currentDetail = Detail_Report::find($request->id);
        $filePath = $currentDetail->file_upload;

        // Perbarui file jika ada file baru
        if ($request->hasFile('file_upload')) {
            $filePath = $request->file('file_upload')->store('uploads', 'public');
        }

        // Tentukan persentase berdasarkan input
        $percentage = $currentDetail->percentage;
        if ($request->link_file || $request->hasFile('file_upload')) {
            $percentage = 100; // Jika salah satu diisi, ubah menjadi 100%
        }

        // Update data Detail_Report
        Detail_Report::where('id', $request->id)->update([
            'description' => $request->description,
            'datetime' => $request->datetime,
            'link_file' => $request->link_file,
            'file_upload' => $filePath,
            'percentage' => $percentage,
            'reports_id' => $request->reports_id,
        ]);

        // Update persentase di tabel Report
        // $report = Report::find($request->reports_id);
        // if ($report && $percentage == 100) {
        //     $report->update(['percentage' => 100]);
        // }

         if (Auth::user()->level === 'Admin') {
                return redirect('/detailReport')->with('Sukses', 'Detail Report Berhasil Ditambahkan');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/detailReport')->with('Sukses', 'Detail Report Berhasil Ditambahkan');
            }

        return redirect()->back()->with('error', 'Data Tidak Lengkap');
        }
    }

    function delete(Request $request)
        {
            $delete = Detail_Report::find($request->id);
            if ($delete) {
                $reportId = $delete->reports_id;

                Detail_Report::where('id', $request->id)->delete();

                $report = Report::find($reportId);

                if ($report) {
                    $report->percentage = 0;
                    $report->save();
                }
                if (Auth::user()->level === 'Admin') {
                    return redirect('/detailReport')->with('Delete', 'Detail Report Berhasil Dihapus');
                } elseif (Auth::user()->level === 'Member') {
                    return redirect('/member/detailReport')->with('Delete', 'Detail Report Berhasil Dihapus');
                }
            }
            return redirect()->back();
        }
}
