<?php

namespace App\Http\Controllers;

use App\Models\PresenceDaily;
use App\Models\SchoolPosition;
use App\Models\SchoolUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PresenceDailyController extends Controller
{
    public function getIndex(Request $request)
    {
        $periode = $request->get('periode');
        $student_name = $request->get('student_name');
        $school_position_id = $request->get('school_position_id');

        $dateRange = [];
        $startDate = $periode ? Carbon::parse(explode(' - ', $periode)[0]) : Carbon::now()->startOfMonth();
        $endDate = $periode ? Carbon::parse(explode(' - ', $periode)[1]) : Carbon::now()->endOfMonth();
        while ($startDate->lte($endDate)) {
            $dateRange[] = $startDate->copy();
            $startDate->addDay();
        }

        $presences = PresenceDaily::whereBetween('presence_date',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
        ->get()
        ->groupBy(['school_user_id', 'presence_date']);

        $students = SchoolUser::query()
            ->when($student_name, function($q) use($student_name) {
                return $q->where('student_name', 'like', "%$student_name%");
            })
            ->when($school_position_id, function($q) use($school_position_id) {
                return $q->where('school_position_id', $school_position_id);
            })
            ->get();
        // dd($student_name, $students);

        $data = [];
        foreach ($students as $key => $student) {
            $temp = (object) [
                'student' => $student,
                'presence' => []
            ];
            foreach ($dateRange as $key => $date) {
                // dd();
                $temp->presence[$date->format('Y-m-d')] = isset($presences[$student->id][$date->format('Y-m-d')]) ? $presences[$student->id][$date->format('Y-m-d')][0] : null;
                // dd($temp->presence[$date->format('Y-m-d')]);
            }
            $data[] = $temp;
        }

        $c = [];
        $c['data'] = $data;
        $c['date_range'] = $dateRange;
        $c['start_date'] = $periode ? Carbon::parse(explode(' - ', $periode)[0]) : Carbon::now()->startOfMonth();
        $c['end_date'] = $periode ? Carbon::parse(explode(' - ', $periode)[1]) : Carbon::now()->endOfMonth();
        $c['positions'] = SchoolPosition::get();

        return view('presence-daily.index', $c);
    }

    public function getDownloadPdf(Request $request)
    {
        $periode = $request->get('periode');
        $student_name = $request->get('student_name');
        $school_position_id = $request->get('school_position_id');

        $dateRange = [];
        $startDate = $periode ? Carbon::parse(explode(' - ', $periode)[0]) : Carbon::now()->startOfMonth();
        $endDate = $periode ? Carbon::parse(explode(' - ', $periode)[1]) : Carbon::now()->endOfMonth();
        $label = $startDate->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') . ' - ' . $endDate->settings(['formatFunction' => 'translatedFormat'])->format('d F Y');

        while ($startDate->lte($endDate)) {
            $dateRange[] = $startDate->copy();
            $startDate->addDay();
        }

        $presences = PresenceDaily::whereBetween('presence_date',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
        ->get()
        ->groupBy(['school_user_id', 'presence_date']);

        $students = SchoolUser::query()
            ->when($student_name, function($q) use($student_name) {
                return $q->where('student_name', 'like', "%$student_name%");
            })
            ->when($school_position_id, function($q) use($school_position_id) {
                return $q->where('school_position_id', $school_position_id);
            })
            ->get();
        // dd($student_name, $students);

        $data = [];
        foreach ($students as $key => $student) {
            $temp = (object) [
                'student' => $student,
                'presence' => []
            ];
            foreach ($dateRange as $key => $date) {
                // dd();
                $temp->presence[$date->format('Y-m-d')] = isset($presences[$student->id][$date->format('Y-m-d')]) ? $presences[$student->id][$date->format('Y-m-d')][0] : null;
                // dd($temp->presence[$date->format('Y-m-d')]);
            }
            $data[] = $temp;
        }

        $c = [];
        $c['data'] = $data;
        $c['date_range'] = $dateRange;
        $c['start_date'] = $periode ? Carbon::parse(explode(' - ', $periode)[0]) : Carbon::now()->startOfMonth();
        $c['end_date'] = $periode ? Carbon::parse(explode(' - ', $periode)[1]) : Carbon::now()->endOfMonth();
        $c['positions'] = SchoolPosition::get();

        // return view('presence-daily.index', $c);
        $pdf = Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugCss' => false])
            ->setPaper('a4', 'landscape')
            ->loadView('presence-daily.pdf', $c);

        return $pdf->download("Rekap Presensi Harian $label.pdf");
        // return view('presence-daily.pdf', $c);
    }

    public function postPermit(Request $request)
    {
        $id = $request->id;

        PresenceDaily::find($id)
            ->update([
                'status' => 'izin',
            ]);

        return true;
    }
}
