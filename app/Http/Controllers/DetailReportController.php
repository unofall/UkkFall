<?php

namespace App\Http\Controllers;

use App\Models\Detail_Report;
use App\Models\Report;
use Illuminate\Http\Request;

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
            'link_file' => ['nullable', 'required'],
            'file_upload' => ['nullable|file', 'mimes:png,jpg,pdf'],
            'percentage' => '',
            'reports_id' => ['required'],
        ]);

        if ($detail) {
            $percentage = 0;

            if ($request->link_file || $request->hasFile('file_upload')) {
                $percentage = 100;
            } else {
                $fieldsFilled = 0;
                $totalFields = 2; // Jumlah total field yang dicek (link_file dan file_upload)

                if ($request->link_file) {
                    $fieldsFilled++;
                }
                if ($request->hasFile('file_upload')) {
                    $fieldsFilled++;
                }

                $percentage = ($fieldsFilled / $totalFields) * 100;
            }
            Detail_Report::create([
                'description' => $request->description,
                'datetime' => $request->datetime,
                'link_file' => $request->link_file,
                'file_upload' => $request->file_upload,
                'percentage' => $percentage,
                'reports_id' => $request->reports_id,
            ]);
            if ($percentage == 100) {
                $report = Report::find($request->reports_id);
                if ($report) {
                    $report->update(['percentage' => 100]);
                }
            }
            return redirect('detailReport')->with('Sukses', 'Detail Report Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('Sukses', 'Data Tidak Lengkap');
        }
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
            'link_file' => ['required'],
            'file_upload' => ['nullable|file', 'mimes:png,jpg,pdf'],
            'report_id' => ['required'],
        ]);

        if ($detail) {
            Detail_Report::where('id', $request->id)->update([
                'description' => $request->description,
                'datetime' => $request->datetime,
                'link_file' => $request->link_file,
                'file_upload' => $request->file_upload,
                'report_id' => $request->report_id,
            ]);
            return redirect('detailReport')->with('update', 'Detail Report Berhasil Diubah');
        } else {
            return redirect()->back()->with('update', 'Data Tidak Lengkap');
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
            return redirect('/detailReport')->with('Delete', 'Detail Report Berhasil Dihapus');

        }
        return redirect()->back();
    }
}
