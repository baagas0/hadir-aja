@extends('layouts.app')
@push('css')
    {{-- <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/> --}}
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    {{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script> --}}



    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>

    <script>
        "use strict";
        $(document).ready(function() {
            function steps() {
                // Stepper lement
                var element = document.querySelector("#kt_stepper_example_vertical");

                // Initialize Stepper
                var stepper = new KTStepper(element);

                // Handle next step
                stepper.on("kt.stepper.next", function (stepper) {
                    stepper.goNext(); // go next step
                });

                // Handle previous step
                stepper.on("kt.stepper.previous", function (stepper) {
                    stepper.goPrevious(); // go previous step
                });

                stepper.goTo(3);
            }

            function chart_daily_presence_monthly() {
                var element = document.getElementById("chart_daily_presence_monthly");

                if (!element) {
                    return;
                }

                var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');

                var options = {
                    series: [{
                        data: [35, 5, 10],
                        show: false
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                            distributed: true,
                            barHeight: 23
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    colors: ['#3E97FF', '#7239EA', '#50CDCD'],
                    xaxis: {
                        categories: ['Hadir', 'Izin', 'Mangkir'],
                        labels: {
                            formatter: function (val) {
                            return val + ""
                            },
                            style: {
                                colors: KTUtil.getCssVariableValue('--bs-gray-400'),
                                fontSize: '14px',
                                fontWeight: '600',
                                align: 'left'
                            }
                        },
                        axisBorder: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: KTUtil.getCssVariableValue('--bs-gray-800'),
                                fontSize: '14px',
                                fontWeight: '600'
                            },
                            offsetY: 2,
                            align: 'left'
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        strokeDashArray: 4
                    }
                };

                var chart = new ApexCharts(element, options);

                // Set timeout to properly get the parent elements width
                setTimeout(function() {
                    chart.render();
                }, 200);

            }

            steps();
            chart_daily_presence_monthly();
        })
    </script>
@endpush
@section('content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-6 mb-md-5 mb-xl-10">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-xl-6 mb-xxl-10">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $presence_daily_today_count }}</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Presensi Harian (hari ini)</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->

                    </div>
                    <!--end::Card widget 5-->
                    <!--begin::Card widget 8-->
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <!--begin::Statistics-->
                            <div class="mb-4 px-9">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Value-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ $presence_daily_today_monthly }}</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Rekap Presensi Harian Bulan Ini</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_card_widget_8_chart" class="min-h-auto" style="height: 125px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 8-->

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-xl-6 mb-xxl-10">
                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $presence_barcode_today_count }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Presensi Kelas (Hari ini)</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Card widget 7-->
                    <!--begin::Card widget 9-->
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <!--begin::Statistics-->
                            <div class="mb-4 px-9">
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Value-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ $presence_barcode_today_monthly }}</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Rekap Presensi Kelas Bulan Ini</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_card_widget_9_chart" class="min-h-auto" style="height: 125px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 9-->

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
        <div class="col-xxl-6 mb-5 mb-xl-10">
            <!--begin::Chart widget 5-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header flex-nowrap pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Grafik Presensi Harian Bulan Ini</span>
                        <span class="text-danger pt-2 fw-semibold fs-6">10% Peserta Didik tidak masuk</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">

                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5 ps-6">
                    <div id="chart_daily_presence_monthly" class="h-350px"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 g-xl-10" style="display: none">
        <div class="col-xl-12 mb-xl-10">
            <!--begin::Engage widget 1-->
            <div class="card h-md-100" dir="ltr">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column flex-center">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-lg-row w-100" id="kt_stepper_example_vertical">
                        <!--begin::Aside-->
                        <div class="d-flex flex-row-auto" style="max-width: 25%; margin-right: 3rem">

                        <!--begin::Nav-->
                        <div class="stepper-nav flex-cente">
                            <!--begin::Step 1-->
                            <div class="stepper-item me-5 current" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Lokasi Sekolah
                                        </h3>

                                        <div class="stepper-desc">
                                            Tambahkan Minimal 1 lokasi sekolah
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 1-->

                            <!--begin::Step 2-->
                            <div class="stepper-item me-5" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <!--begin::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Jabatan/Kelas
                                        </h3>

                                        <div class="stepper-desc">
                                            Tambahkan Minimal 1, data ini digunakan untuk mempermudah identifikasi pengguna
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 2-->

                            <!--begin::Step 3-->
                            <div class="stepper-item me-5" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <!--begin::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Grup Sekolah
                                        </h3>

                                        <div class="stepper-desc">
                                            Buat grup sekolah agar mempermudah dalam pengelompokan pengguna
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 3-->

                            <!--begin::Step 4-->
                            <div class="stepper-item me-5" data-kt-stepper-element="nav">
                                <!--begin::Wrapper-->
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>
                                    <!--begin::Icon-->

                                    <!--begin::Label-->
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Jam Masuk
                                        </h3>

                                        <div class="stepper-desc">
                                            Atur jam masuk sesuai dengan peraturan sekolah, anda memungkinkan untuk menambahkan lebih dari 1 jam masuk
                                        </div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 4-->
                        </div>
                        <!--end::Nav-->
                        </div>

                        <!--begin::Content-->
                        <div class="flex-row-fluid">
                            <!--begin::Form-->
                            <form class="form mx-auto" novalidate="novalidate">
                                <!--begin::Group-->
                                <div class="mb-5">
                                    <!--begin::Step 1-->
                                    <div class="flex-column current" data-kt-stepper-element="content">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 1</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input1" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 2</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input2" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 3</label>
                                            <!--end::Label-->

                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" checked="checked" value="1"/>
                                                <span class="form-check-label">
                                                    Switch
                                                </span>
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Step 1-->

                                    <!--begin::Step 1-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                    <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 1</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input1" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 2</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid" rows="3" name="input2" placeholder=""></textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">Example Label 3</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <label class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" checked="checked" type="checkbox" value="1"/>
                                                <span class="form-check-label">
                                                    Checkbox
                                                </span>
                                            </label>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Step 1-->

                                    <!--begin::Step 1-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label d-flex align-items-center">
                                                <span class="required">Input 1</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Example tooltip"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input1" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">
                                                Input 2
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input2" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Step 1-->

                                    <!--begin::Step 1-->
                                    <div class="flex-column" data-kt-stepper-element="content">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label d-flex align-items-center">
                                                <span class="required">Input 1</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Example tooltip"></i>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input1" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">
                                                Input 2
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input2" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label">
                                                Input 3
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" name="input3" placeholder="" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Step 1-->
                                </div>
                                <!--end::Group-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="me-2">
                                        <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                                            Back
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->

                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
                                            <span class="indicator-label">
                                                Submit
                                            </span>
                                            <span class="indicator-progress">
                                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>

                                        <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                            Continue
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Stepper-->
                </div>
            </div>
        </div>

    </div>
    <!--end::Row-->

@endsection
