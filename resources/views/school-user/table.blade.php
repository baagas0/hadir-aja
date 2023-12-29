@php
    $title = 'Pengguna';
    $_id = 'school-users-table';
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
<div class="table-responsive">

    <table id="table_{{ $_id }}" class="table align-middle table-row-dashed fs-6 gy-5">
        <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input form-check-all" type="checkbox" data-kt-check="true" data-kt-check-target="#{{ $_id }} .form-check-input" value="1"/>
                </div>
            </th>
            <th>No Identitas</th>
            <th>Nama</th>
            <th>Group</th>
            <th>Jabatan/Kelas</th>
            <th>Kelamin</th>
            <th>Email</th>
            <th>No Telf</th>
            <th>Tanggal Lahir</th>
            <th>Lokasi Presensi</th>
            <th class="text-end min-w-100px">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
        </tbody>
    </table>

</div>
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
                            <span class="required">No Identitas</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="No Identitas dapat berupa NIS, NISN, NUPTK, dan lain sebagainya">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan No Identitas {{ $title }}" name="student_number">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input Nama Pengguna">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan Nama {{ $title }}" name="student_name">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Grup Sekolah</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Grup Sekolah">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <select class="form-select form-select-solid" data-placeholder="Select an option" name="school_group_id">
                            @foreach($school_groups as $item)
                                <option value="{{ $item->id }}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Jabatan di Sekolah</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Grup Sekolah">
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
                            <span class="required">Jenis Kelamin</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Jenis Kelamin">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <select class="form-select form-select-solid" data-placeholder="Select an option" name="gender">
                            <option>Laki Laki</option>
                            <option>Perempuan</option>
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input Email Pengguna">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan Email {{ $title }}" name="email">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">No Telf</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input No Telf Pengguna">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Masukan No Telf {{ $title }}" name="phone_number">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal Lahir</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Input Tanggal Lahir Pengguna">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="date" class="form-control form-control-solid" placeholder="Masukan Tanggal Lahir {{ $title }}" name="birth_date">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="fv-row mb-7">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack">
                            <!--begin::Label-->
                            <div class="me-5">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold">Izinkan presensi disemua lokasi?</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="fs-7 fw-semibold text-muted">Pilih jika pengguna dengan grup ini dapat membuat presensi kelas.</div>
                                <!--end::Input-->
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input" name="is_all_location_presence" type="checkbox" value="1" id="is_all_location_presence">
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label fw-semibold text-muted" for="is_all_location_presence">Ya</span>
                                <!--end::Label-->
                            </label>
                            <!--end::Switch-->
                        </div>
                        <!--begin::Wrapper-->
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container" id="school_location_id_element">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Lokasi Presensi</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Lokasi Presensi">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <select class="form-select form-select-solid" data-placeholder="Select an option" name="school_location_id">
                            @foreach($school_locations as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
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

