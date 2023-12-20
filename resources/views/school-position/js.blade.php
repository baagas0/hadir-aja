@php
    $title = 'Jabatan/Kelas';
    $_id = 'school-position-table';
    $route = [
        'detail' => route('school-position.data.detail'),
        'update' => route('school-position.update'),
        'store' => route('school-position.store'),
        'delete' => route('school-position.delete'),
        'bulk-delete' => route('school-position.bulk.delete'),
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
                    url: "{{ route('school-position.data') }}",
                },
                columns: [
                    { data: 'id' },
                    { data: 'position_code' },
                    { data: 'position_name' },
                    { data: null },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data) {
                            return `
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="${data}" data-type="row" />
                                </div>`;
                        }
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
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
                handleDeleteRows();
                KTMenu.createInstances();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('change', function (e) {
                if(e.target.value.length > 2) dt.search(e.target.value).draw();
            });
        }

        // Filter Datatable
        var handleFilterDatatable = () => {
            
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
            // Toggle selected action toolbar
            // Select all checkboxes
            const container = document.querySelector('#table_{{ $_id }}');
            const checkboxes = container.querySelectorAll('[type="checkbox"]');
            
            // Select elements
            const deleteSelected = document.querySelector('[data-kt-docs-table-select="delete_selected"]');
            
            // Listen select all checkbox
            // Remove header checked box
            const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
            headerCheckbox.checked = false;
            $('.form-check-all').on('click', function(e) {
                checkboxes.forEach(c => {
                    setTimeout(function () {
                        c.checked = e.target.checked
                    }, 50);
                });
            })

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            deleteSelected.addEventListener('click', function () {
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                var requestError = false;
                var selected = [];

                const ch = container.querySelectorAll('[type="checkbox"]');
                ch.forEach(c => {
                    if (c.dataset && c.dataset.type && c.dataset.type === 'row' && c.checked) {
                        selected.push(c.value);
                    }
                });
                
                Swal.fire({
                    text: "Anda yakin ingin menghapus data terpilih?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    // showLoaderOnConfirm: true,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, tutup",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    },
                    preConfirm: async () => {
                        await $.ajax({
                            url: '{{ $route["bulk-delete"] }}',
                            method: 'post',
                            data: { ids: selected },
                            dataType: 'json',
                            cache: false,
                            beforeSend: function () {
                                
                            },
                            success: function(res){
                                requestError = false;
                                return true;
                            },
                            error: function(error) {
                                requestError = true;
                                let res = error.responseJSON;
                                Swal.showValidationMessage(res.message || 'Terjadi Kesalahan');
                                $('.swal2-cancel').text('Tutup');
                                $('.swal2-cancel').attr('disabled', false);
                                // return false;
                            }
                        });
                    }
                }).then(function (result) {
                    if (result.value && !requestError) {
                        // Simulate delete request -- for demo purpose only
                        Swal.fire({
                            text: "Menghapus data terpilih",
                            icon: "info",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            console.log('success');   
                            Swal.fire({
                                text: "Data berhasil terhapus!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // delete row data from server and re-draw datatable
                                dt.draw();
                            });
                        })


                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Data gagal dihapus.",
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
        }

        // Toggle toolbars
        var toggleToolbars = function () {
            // Define variables
            const container = document.querySelector('#table_{{ $_id }}');
            const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
            const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
            const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

            // Select refreshed checkbox DOM elements
            const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });
            
            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
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
                handleResetForm();
                modalShow();
                formSubmit();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
        
    });
</script>