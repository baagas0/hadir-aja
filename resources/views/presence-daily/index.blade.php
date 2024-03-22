@php
    $periode = request()->get('periode');
    $month_name = [];
    foreach ($date_range as $date) {
        // dd($date);
        $title = $date->settings(['formatFunction' => 'translatedFormat'])->format('F Y');
        if(isset($month_name[$title])) {
            $month_name[$title][] = $date;
        } else {
            $month_name[$title] = [];
            $month_name[$title][] = $date;
        }
    }
    // dd($month_name);
@endphp
@extends('layouts.app')
@push('css')
    <style>
        .pac-container {
            z-index: 99999;
        }

        .row-sticky {
            position: sticky;
            left: 0;
            z-index: 2;
            background-color: #fff !important;
        }
        tr th, tr td {
            border-width: 1px !important;
            border: 1px solid #000;
        }

        .layout-keterangan {
            display: flex;
            width: 24px;
            height: 24px;
            padding: 5px 8px 4px 8px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 4px;
            border-radius: 8px;
            border: 1px solid var(--color-greyscale-200,#d3d3d3);
        }
    </style>
    <style>
        .popover-item{
            position: relative;
            --bs-popover-zindex: 1070;
            --bs-popover-max-width: 276px;
            --bs-popover-font-size: 1rem;
            --bs-popover-bg: #ffffff;
            --bs-popover-border-width: var(--bs-border-width);
            --bs-popover-border-color: #ffffff;
            --bs-popover-border-radius: 0.475rem;
            --bs-popover-inner-border-radius: 0.475rem;
            --bs-popover-box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
            --bs-popover-header-padding-x: 1.25rem;
            --bs-popover-header-padding-y: 1rem;
            --bs-popover-header-font-size: 1rem;
            --bs-popover-header-color: var(--bs-gray-800);
            --bs-popover-header-bg: #ffffff;
            --bs-popover-body-padding-x: 1.25rem;
            --bs-popover-body-padding-y: 1.25rem;
            --bs-popover-body-color: var(--bs-gray-800);
            --bs-popover-arrow-width: 1rem;
            --bs-popover-arrow-height: 0.5rem;
            --bs-popover-arrow-border: var(--bs-popover-border-color);
            /* z-index: var(--bs-popover-zindex); */
            /* display: block; */
            max-width: var(--bs-popover-max-width);
            font-family: var(--bs-font-sans-serif);
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            white-space: normal;
            word-spacing: normal;
            line-break: auto;
            font-size: var(--bs-popover-font-size);
            /* word-wrap: break-word; */
            background-color: var(--bs-popover-bg);
            background-clip: padding-box;
            /* border: var(--bs-popover-border-width) solid var(--bs-popover-border-color); */
            border-radius: var(--bs-popover-border-radius);
            /* box-shadow: var(--bs-popover-box-shadow); */
        }
        .popover-content{
            display:none;
            position: absolute;
            left: 105%;
            /* display: none; */
            /* font-size: 1.2rem; */
            /* background-color: rgba(230, 230, 230, 1); */
            background-color: var(--bs-popover-bg);
            background-clip: padding-box;
            border-radius: var(--bs-popover-border-radius);
            /* padding: 5px 10px; */
            /* border-radius: 8px; */
            /* font-family: Tahoma, Verdana, Segoe, sans-serif;
            font-weight: normal; */
            z-index:111;
            width:300px;
        }
        .popover-header {
            font-size: 1rem;
            font-weight: 500;
            border-bottom: 1px solid #F1F1F4 !important;
            z-index:112;
        }
        .popover-body {
            padding: var(--bs-popover-body-padding-y) var(--bs-popover-body-padding-x);
            color: var(--bs-popover-body-color);
        }
        .popover-content:hover{
            display:none!important;

        }
        .popover-item:hover .popover-content{
            display: block;
        }
        .popover-content h1{
            font-size:20px;
        }
    </style>
@endpush
@push('js')
    {{-- @include('presence-daily.js') --}}
    <script>
        @if($periode)
        var start = moment('{{ explode(' - ', $periode)[0] }}', 'D/M/yyyy');
        var end = moment('{{ explode(' - ', $periode)[1] }}', 'D/M/yyyy');
        @else
        var start = moment().startOf("month");
        var end = moment().endOf("month");
        @endif

        function cb(start, end) {
            $("#periode").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#periode").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hari Ini": [moment(), moment()],
                "Kemarin": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "7 Hari Terakhir": [moment().subtract(6, "days"), moment()],
                "30 Hari Terakhir": [moment().subtract(29, "days"), moment()],
                "Bulan Ini": [moment().startOf("month"), moment().endOf("month")],
                "Bulan Kemarin": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            },
            locale: {
                format: 'DD-MM-YYYY'
            }
            // dateFormat: 'dd-mm-yyyy'
        }, cb);

        cb(start, end);

    </script>

    <script>
        /* Script for popover positioning */
        (function(selector, horizontalOffset, verticalOffset) {
        var items;

        selector = selector || '.popover-item';
        horizontalOffset = horizontalOffset || 5;
        verticalOffset = verticalOffset || 5;

        items = document.querySelectorAll(selector);
        items = Array.prototype.slice.call(items);

        items.forEach(function(item) {
            // Every time the pointer moves over the element the
            //  CSS-rule in overwritten with new values for
            //  top and left.
            item.addEventListener('mousemove', function(e) {
                let countCssRules = document.styleSheets[2].cssRules.length;
                var rightSpace = document.body.clientWidth - e.pageX;
                if( rightSpace > 300 ){
                    var newRule = selector +
                    ':hover .popover-content {  ' +
                                'right:auto; left: ' + (horizontalOffset + e.offsetX) + 'px; ' +
                                'top: ' +  (e.offsetY + verticalOffset) + 'px; }';
                }else{
                    var newRule = selector +
                    ':hover .popover-content {  ' +
                                'left:auto; right: ' + (item.offsetWidth - e.offsetX) + 'px; ' +
                                'top: ' +  (e.offsetY + verticalOffset) + 'px; }';
                }

                document.styleSheets[2].insertRule(newRule, countCssRules);
            });
        });
        })('.popover-item', 10, 5);
    </script>
@endpush
@section('content')
    {{-- @include('presence-daily.table') --}}

    <div class="mb-6">
        <form action="">
            <div class="row mb-3">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Periode Presensi</label>
                        <input class="form-control form-control-solid" placeholder="Pick date rage" id="periode" name="periode">
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <input class="form-control form-control-solid" placeholder="Nama" id="student_name" name="student_name" value="{{ request()->get('student_name') }}">
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="form-label">Jabatan/Kelas</label>
                        <select class="form-select form-select-solid" aria-label="Pilih Jabatan/Kelas" name="school_position_id">
                            <option value=" ">Pilih Jabatan/Kelas</option>
                            @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ request()->get('school_position_id') == $position->id ? 'selected' : '' }}>{{ $position->position_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-icon-primary btn-light-primary btn-sm">
                    <i class="ki-duotone ki-filter-search">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Terapkan
                </button>
                <button class="btn btn-icon-white btn-warning btn-sm">
                    <i class="ki-duotone ki-document">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Download Rekap
                </button>
            </div>
        </form>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="row-sticky w-40px text-center" style="vertical-align: middle">#</th>
                    <th rowspan="2" class="row-sticky" style="vertical-align: middle; min-width: 200px">Nama</th>
                    <th rowspan="2" style="vertical-align: middle; min-width: 150px">Jabatan/Kelas</th>

                    {{-- @if($periode)
                        <th colspan="{{ count($date_range) }}">
                            {{ \Carbon\Carbon::parse(explode(' - ', $periode)[0])->settings(['formatFunction' => 'translatedFormat'])->format('d M Y') }}
                            s/d
                            {{ \Carbon\Carbon::parse(explode(' - ', $periode)[1])->settings(['formatFunction' => 'translatedFormat'])->format('d M Y') }}
                        </th>
                    @else
                        <th colspan="{{ count($date_range) }}">
                            {{ $start_date->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('F Y') }}
                        </th>
                    @endif --}}
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
                        {{-- @if(($val->color ?? 'danger') === 'success') --}}
                            <td class="popover-item bg-light-{{ $val->color ?? 'danger' }}">
                                <div class="popover-content">
                                    {{-- <h1>Cell 1 - Tooltip/Popover</h1>
                                    <p>This is a Tooltip/Popover following the mouse pointer on hover</p> --}}
                                    <div class="popover-header">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</div>
                                    <div class="popover-body">
                                        Status:  {{ $val->status ?? '-' }}<br />
                                    </div>
                                </div>
                            </td>
                            {{-- @endif --}}
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="d-flex gap-5">
        <div class="d-flex flex-row align-items-center justify-content-center gap-2">
            <div class="layout-keterangan bg-light-success"></div>
            <small>Hadir</small>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-center gap-2">
            <div class="layout-keterangan bg-light-warning"></div>
            <small>Izin</small>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-center gap-2">
            <div class="layout-keterangan bg-light-info"></div>
            <small>Sakit</small>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-center gap-2">
            <div class="layout-keterangan bg-light-danger"></div>
            <small>Mangkir/Tidak hadir</small>
        </div>
    </div>
@endsection
