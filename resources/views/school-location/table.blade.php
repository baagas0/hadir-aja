@php
    $title = 'Lokasi Sekolah';
    $_id = 'school-location-table';
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
        <th>Nama</th>
        <th>Alamat</th>
        <th>Lokasi</th>
        <th>Toleransi Radius</th>
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

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input Nama Lokasi, ex: Gedung A">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan Nama {{ $title }}" name="title">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>


                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Alamat Lengkap</span>
                        </label>
                        <!--end::Label-->
                        <textarea name="address" class="form-control form-control-solid" id="address" cols="3" rows="3" required></textarea>
                        {{-- <textarea type="text"  placeholder="Masukan Nama {{ $title }}" name="name"> --}}
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Lokasi</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukan nama lokasi anda untuk mencari disini.">
                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Masukan Nama Lokasi" name="location" id="location">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Radius Presensi</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukan radius presensi.">
                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" class="form-control form-control-solid" placeholder="Masukan Radius Presensi" name="radius_distance" id="radius_distance">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="">Maps</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Geser pin untuk memindahkan lokasi.">
                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <div id="maps" style="width: 100%; height: 300px"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 d-none">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Latitude</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Latitude Presensi" name="lat" id="lat" readonly>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12 d-none">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Longitude</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="number" class="form-control form-control-solid" placeholder="Latitude Presensi" name="long" id="long" readonly>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
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

