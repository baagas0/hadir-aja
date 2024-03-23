@php
    $periode = request()->get('periode');
    $month_name = [];
    foreach ($date_range as $date) {
        $title = $date->settings(['formatFunction' => 'translatedFormat'])->format('F Y');
        if(isset($month_name[$title])) {
            $month_name[$title][] = $date;
        } else {
            $month_name[$title] = [];
            $month_name[$title][] = $date;
        }
    }

    $startDate = $periode ? \Carbon\Carbon::parse(explode(' - ', $periode)[0]) : \Carbon\Carbon::now()->startOfMonth();
    $endDate = $periode ? \Carbon\Carbon::parse(explode(' - ', $periode)[1]) : \Carbon\Carbon::now()->endOfMonth();
    $label = $startDate->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') . ' - ' . $endDate->settings(['formatFunction' => 'translatedFormat'])->format('d F Y');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* table {
            border-collapse: collapse
        } */

        .table-bordered tr th, .table-bordered tr td {
            border-width: 1px !important;
            border: 1px solid #000;
        }

        .table {
            border-collapse: collapse;
            margin-bottom: 35px;
            font-size:12px;
        }

        .table td {
            padding: 3px 6px;
            text-align: center;
            white-space:nowrap;
        }

        thead td {
            background-color: #445;
            color: #fff;
            font-weight: bold;
        }

        thead td:first-child {
            border-radius: 5px 0 0 0;
        }

        thead td:last-child {
            border-radius: 0 5px 0 0;
        }

        tbody tr:nth-child(even) {
            background-color: #ccd;
        }

        tbody tr:last-child {
            border-bottom: 1px solid #445;
        }

        .layout-keterangan {
            display: flex;
            width: 20px;
            height: 20px;
            padding: 5px 8px 4px 8px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 4px;
            border-radius: 8px;
            border: 1px solid var(--color-greyscale-200,#d3d3d3);
        }

        .bg-light-danger{
            background-color: #FFEEF3
        }
        .bg-light-success{
            background-color: #DFFFEA
        }
        .bg-light-warning{
            background-color: #FFF8DD
        }
        .bg-light-info{
            background-color: #F8F5FF
        }

        .gap-2 {
            gap: .5rem !important;
        }
        .align-items-center {
            align-items: center !important;
        }
        .justify-content-center {
            justify-content: center !important;
        }
        .flex-row {
            flex-direction: row !important;
        }
        .d-flex {
            display: flex !important;
        }
        .justify-content-between {
            justify-content: space-between !important;
        }

        .header,
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            font-size: 18px;
        }
        .header {
            top: 0px;
        }
        .footer {
            bottom: 0px;
        }
        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>
<body>
    <div class="footer">
        &copy; Hadir Aja | Page <span class="pagenum"></span>
    </div>

    <div style="text-align: center; margin-bottom: 1.25rem">
        <h5 style="margin-bottom: 10px">Rekap Presensi Harian</h5>
        <p style="margin-bottom: 0px; margin-top: 0px; font-size: 15px">{{ $label }}</p>
    </div>

    <table class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th rowspan="2" class="row-sticky w-40px text-center" style="vertical-align: middle">#</th>
                <th rowspan="2" class="row-sticky" style="vertical-align: middle; min-width: 200px">Nama</th>
                <th rowspan="2" style="vertical-align: middle; min-width: 150px">Jabatan/Kelas</th>

                @foreach ($month_name as $title => $item)
                    <th colspan="{{ count($item) }}">
                        {{ $title }}
                    </th>
                @endforeach
            </tr>
            <tr>
                @foreach ($date_range as $date)
                    <th class="w-20px">{{ $date->format('d') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="row-sticky w-40px text-center">{{ $loop->iteration }}</td>
                    <td class="row-sticky">{{ $item->student->student_name }}</td>
                    <td>{{ $item->student->school_position->position_name }}</td>

                    @foreach ($item->presence as $date => $val)
                        <td class="bg-light-{{ $val->color ?? 'danger' }}">

                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tr>
            <td class="layout-keterangan bg-light-success"></td>
            <td style="font-size: 15px">
                <small>Hadir</small>
            </td>

            <td style="width: 10px"></td>

            <td class="layout-keterangan bg-light-warning"></td>
            <td style="font-size: 15px">
                <small>Izin</small>
            </td>

            <td style="width: 10px"></td>

            <td class="layout-keterangan bg-light-info"></td>
            <td style="font-size: 15px">
                <small>Sakit</small>
            </td>

            <td style="width: 10px"></td>

            <td class="layout-keterangan bg-light-danger"></td>
            <td style="font-size: 15px">
                <small>Mangkir/Tidak hadir</small>
            </td>
        </tr>
    </table>
</body>
</html>
