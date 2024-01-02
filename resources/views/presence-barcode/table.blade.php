@php
    $title = 'Presensi Kelas (Barcode)';
    $_id = 'presence-barcode-table';
@endphp

<!--begin::Wrapper-->
<div class="d-flex flex-stack mb-5">
    <div class="row w-100">
        <div class="col-xl-6 col-md-6 col-sm-12">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari {{ $title }}"/>
            </div>
            <!--end::Search-->
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                <!--begin::Add customer-->
                <button type="button" class="btn btn-primary"  title="Tambah Data" data-bs-toggle="modal" data-bs-target="#modal_{{ $_id }}" data-state="create">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Tambah {{ $title }}
                </button>
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                <div class="fw-bold me-5">
                    <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                </div>

                <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected" data-bs-toggle="tooltip" title="Coming Soon">
                    Selection Action
                </button>
            </div>
            <!--end::Group actions-->
        </div>
    </div>


</div>
<!--end::Wrapper-->

<!--begin::Datatable-->
<table id="table_{{ $_id }}" class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
        <th class="w-10px pe-2">
            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input form-check-all" type="checkbox" data-kt-check="true" data-kt-check-target="#{{ $_id }} .form-check-input" value="1"/>
            </div>
        </th>
        <th>Hari/Tanggal</th>
        <th>Judul</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Durasi</th>
        <th>Deskripsi</th>
        <th class="text-end min-w-100px">Actions</th>
    </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
    </tbody>
</table>
<!--end::Datatable-->

<div class="modal fade" tabindex="-1" id="modal_{{ $_id }}">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form method="POST" action="" id="form_{{ $_id }}">

                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3" id="modal_title_{{ $_id }}">Set First Target</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Masukan data sesuai dengan form yang tersedia.</div>
                        <!--end::Description-->
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container" id="school_position_id">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tujuan Absensi</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Tujuan Absensi">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <select class="form-select form-select-solid" data-placeholder="Select an option" name="school_position_id">
                            @foreach($school_positions as $item)
                                <option value="{{ $item->id }}">{{ $item->position_name }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input Judul, ex: Presensi Matematika">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan Judul {{ $title }}" name="title">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal</span>
                        </label>
                        <!--end::Label-->
                        <input type="date" class="form-control form-control-solid" placeholder="Masukan Tanggal {{ $title }}" name="date">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Jam Masuk</span>
                                </label>
                                <!--end::Label-->
                                <input type="time" class="form-control form-control-solid" placeholder="Masukan Waktu Masuk {{ $title }}" name="actual_hour_in">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Jam Pulang</span>
                                </label>
                                <!--end::Label-->
                                <input type="time" class="form-control form-control-solid" placeholder="Masukan Waktu Pulang {{ $title }}" name="actual_hour_out">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

