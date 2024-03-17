{{-- http://maps.google.com/maps?z=12&t=m&q=loc:38.9419+-78.3020 --}}
@php
    $title = 'Presensi Harian';
    $_id = 'presence-daily-table';
    $route = [
        'detail' => '',
        'update' => '',
        'store' => '',
        'delete' => '',
        'bulk-delete' => '',
    ];
@endphp
<script>
    "use strict";

    // Class definition
    var KTDatatablesServerSide = function () {
        // Shared variables
        var table;
        var dt;
        var filterPayment;

        // Private functions
        var initDatatable = function () {
            dt = $("#table_{{ $_id }}").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [[1, 'desc']],
                stateSave: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ route('presence-daily.data') }}",
                },
                columns: [
                    { data: 'id' },
                    { data: 'school_user.student_name' },
                    { data: 'presence_day' },
                    { data: 'hour_in' },
                    { data: 'hour_out' },
                    { data: 'state' },
                    { data: 'status' },
                    { data: null },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 2,
                        orderable: false,
                        render: function (data, type, row) {
                            const tanggal = row.presence_date;
                            const newDate = new Date(tanggal);
                            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                            const formattedDate = newDate.getDate() + " " + monthNames[newDate.getMonth()] + " " + newDate.getFullYear();

                            return `${data}, ${formattedDate}`;
                        }
                    },
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data, type, row) {
                            return data ?? '-';
                        }
                    },
                    {
                        targets: 4,
                        orderable: false,
                        render: function (data, type, row) {
                            return data ?? '-';
                        }
                    },
                    {
                        targets: 5,
                        orderable: false,
                        render: function (data, type, row) {
                            if(data == 'tidak diketahui') return '-';

                            return data.charAt(0).toUpperCase() + data.slice(1);
                        }
                    },
                    {
                        targets: 6,
                        orderable: false,
                        render: function (data, type, row) {
                            const text = data.charAt(0).toUpperCase() + data.slice(1);

                            const color = {
                                'hadir': 'success',
                                'izin': 'info',
                                'mangkir': 'danger',
                            };
                            const e = `<div class="badge badge-${color[data]}">${text}</div>`;

                            return e;
                        }
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            let izin = ''
                            if(row.state == 'tidak diketahui' && row.status === 'mangkir') {
                                izin = `
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 izinnnnnnnn"  data-permit-button="permit_button" data-id="${row.id}">
                                            Izinkan
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                `;
                            }

                            return `
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                    Actions
                                    <span class="svg-icon fs-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    ${izin}

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 update" data-kt-docs-table-filter="edit_row" data-state="update" data-bs-toggle="modal" data-bs-target="#modal_{{ $_id }}" data-id="${row.id}">
                                            Edit
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row" data-id="${row.id}">
                                            Delete
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            `;
                        },
                    },
                ]
            });

            table = dt.$;

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            dt.on('draw', function () {
                initToggleToolbar();
                toggleToolbars();
                handlePermitRows();
                handleDeleteRows();
                KTMenu.createInstances();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('change', function (e) {
                // if(e.target.value.length > 2) dt.search(e.target.value).draw();
                dt.search(e.target.value).draw();
            });
        }

        // Filter Datatable
        var handleFilterDatatable = () => {

        }

        // Delete customer
        var handlePermitRows = (event) => {
            // Select all delete buttons
            $('a.izinnnnnnnn').click(function(){
                console.log('logggging')
            });

            $(".izinnnnnnnn").each(function () {
                console.log('cok')
            });

            const permitButtons = document.querySelectorAll('.izinnnnnnnn');
            console.log(permitButtons)
            permitButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = e.target.dataset.id;

                    Swal.fire({
                        text: "Apakah anda yakin ingin mengizinkan peserta didik ini?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Ya, izinkan!",
                        cancelButtonText: "Tidak, tutup",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        },
                        preConfirm: async () => {
                            await $.ajax({
                                url: `{{ route('presence-daily.permit') }}`,
                                method: 'post',
                                data: { id: id },
                                dataType: 'json',
                                cache: false,
                                beforeSend: function () {

                                },
                                success: function(res){
                                    return res;
                                },
                                error: function(error) {
                                    let res = error.responseJSON;
                                    Swal.showValidationMessage(res.message || 'Terjadi Kesalahan');
                                    $('.swal2-cancel').text('Tutup');
                                    $('.swal2-cancel').attr('disabled', false);
                                    // return false;
                                }
                            });
                        }
                    }).then(function (result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            Swal.fire({
                                text: "Memproses izin peserta didik",
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "Peserta didik telah diizinkan.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // delete row data from server and re-draw datatable
                                    dt.draw();
                                });
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: title + " tidak terhapus.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            });
        }

        // Delete customer
        var handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = e.target.dataset.id;

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get customer name
                    const title = parent.querySelectorAll('td')[1].innerText;

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Apakah anda yakin ingin menghapus data " + title + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Tidak, tutup",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        },
                        preConfirm: async () => {
                            await $.ajax({
                                url: '{{ $route["delete"] }}',
                                method: 'post',
                                data: { id: id },
                                dataType: 'json',
                                cache: false,
                                beforeSend: function () {

                                },
                                success: function(res){
                                    return res;
                                },
                                error: function(error) {
                                    let res = error.responseJSON;
                                    Swal.showValidationMessage(res.message || 'Terjadi Kesalahan');
                                    $('.swal2-cancel').text('Tutup');
                                    $('.swal2-cancel').attr('disabled', false);
                                    // return false;
                                }
                            });
                        }
                    }).then(function (result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            Swal.fire({
                                text: "Menghapus " + title,
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "You have deleted " + title + "!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // delete row data from server and re-draw datatable
                                    dt.draw();
                                });
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: title + " tidak terhapus.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });
        }

        // Reset Filter
        var handleResetForm = () => {

        }

        // Init toggle toolbar
        var initToggleToolbar = function () {

        }

        // Toggle toolbars
        var toggleToolbars = function () {

        }

        // MODAL SHOW
        var modalShow = function () {
            const m = document.getElementById('modal_{{ $_id }}');
            m.addEventListener('hidden.bs.modal', event => {
                const form = $('#form_{{ $_id }}');
                // form.trigger('reset');
                for (const item of form.serializeArray()) {
                    const el = $(`[name="${item.name}"]`);
                    if (el.length && el[0].tagName.toLowerCase() === 'input') {
                        el.val('');
                    } else if (el.length && el[0].tagName.toLowerCase() === 'textarea') {
                        el.val('');
                    } else if (el.length && el[0].tagName.toLowerCase() === 'select') {
                        el.val(0).change();
                    }
                }
                // $(`#address`).val('');
            });
            m.addEventListener('show.bs.modal', event => {
                const relatedTarget = event.relatedTarget;
                const state = relatedTarget.dataset.state;
                const id = relatedTarget.dataset.id;
                const form = $('#form_{{ $_id }}');

                if (state === 'update') {
                    $('#modal_title_{{ $_id }}').text('Edit {{ $title }}');
                    form.attr('action', `{{ $route["update"] }}/${id}`);
                    $.ajax({
                        url: '{{  $route["detail"] }}',
                        method: 'get',
                        data: { id: id },
                        dataType: 'json',
                        cache: false,
                        success: function(res){
                            // console.log(res);
                            const data = res.data;
                            for (const column in data) {
                                if (Object.hasOwnProperty.call(data, column)) {
                                    const val = data[column];
                                    // $(`input[name="${column}"]`).val(val);
                                    const el = $(`[name="${column}"]`);

                                    if (el.length && el[0].tagName.toLowerCase() === 'input') {
                                        el.val(val);
                                    } else if (el.length && el[0].tagName.toLowerCase() === 'textarea') {
                                        el.val(val);
                                    } else if (el.length && el[0].tagName.toLowerCase() === 'select') {
                                        el.val(val).change();
                                    }
                                }
                            }
                        },
                        error: function(error) {
                            let data = error.responseJSON;

                            Swal.fire({
                                text: data.message || "Terjadi Kesalahan",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Tutup!",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            });
                        }
                    });
                } else if (state === 'create') {
                    $('#modal_title_{{ $_id }}').text('Tambah {{ $title }}');
                    form.attr('action', '{{ $route["store"] }}');
                }
            })
        }

        var buildValue = function (form_element) {
            var paramObj = {};
            $.each(form_element.serializeArray(), function(_, kv) {
                if (paramObj.hasOwnProperty(kv.name)) {
                    paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                    paramObj[kv.name].push(kv.value);
                }
                else {
                    paramObj[kv.name] = kv.value;
                }
            });
            return paramObj;
        }
        var formSubmit = function () {
            const form = $('#form_{{ $_id }}');

            form.on('submit', function (e) {
                e.preventDefault();

                const m = document.getElementById('modal_{{ $_id }}');
                const modal = bootstrap.Modal.getInstance(m);

                const data = buildValue(form);
                // console.log(data);

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: data,
                    dataType: 'json',
                    cache: false,
                    success: function(res){
                        Swal.fire({
                            text: res.message || "Data berhasil disimpan",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => {
                            console.log('success');
                            modal.hide();
                            dt.draw();

                        })
                    },
                    error: function(error) {
                        let data = error.responseJSON;

                        Swal.fire({
                            text: data.message || "Terjadi Kesalahan",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Tutup!",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        });
                    }
                });
            })

        }

        // Public methods
        return {
            init: function () {
                initDatatable();
                handleSearchDatatable();
                initToggleToolbar();
                handleFilterDatatable();
                handleDeleteRows();
                handlePermitRows();
                handleResetForm();
                modalShow();
                formSubmit();
            },
            handlePermitRows: function() {
                handlePermitRows();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();

    });
</script>
