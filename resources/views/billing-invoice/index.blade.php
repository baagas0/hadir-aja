@extends('layouts.app')
@push('css')
@endpush
@push('js')
@endpush
@section('content')
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100 mb-3">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Faktur Digital
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="index.html" class="text-muted text-hover-primary">Langganan</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Faktur Aktif</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>

    @if($billing)
        @include('billing-invoice.invoice')
    @else
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body p-0">
                <!--begin::Wrapper-->
                <div class="card-px text-center py-20 my-10">
                    <!--begin::Title-->
                    <h2 class="fs-2x fw-bold mb-10">Langganan tidak ditemukan</h2>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="text-gray-500 fs-4 fw-semibold mb-10">Belum ada langganan yang ditambahkan.
                        <br />Mulailah bisnis Anda dengan menambahkan langganan pertama Anda
                    </p>
                    <!--end::Description-->
                    <!--begin::Action-->
                    <a href="apps/subscriptions/add.html" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#register_trial_modal">Uji coba gratis 30 hari</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt=""
                        src="{{ asset('assets/media/illustrations/sketchy-1/5.png') }}" />
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
  
        <div class="modal fade" tabindex="-1" id="register_trial_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('billing-invoice.register.trial') }}" method="POST">
                      @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Syarat & Ketentuan Paket Trial</h5>
    
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
    
                        <div class="modal-body" style="min-height: 1000px">
                            <h1>Syarat dan Ketentuan Paket Trial Platform HadirAja</h1>
    
                            <h2>1. Definisi</h2>
    
                            <p>Dalam syarat dan ketentuan ini, yang dimaksud dengan:</p>
    
                            <ul>
                                <li>"Platform HadirAja" adalah platform presensi berbasis website dan mobile untuk mempermudah
                                    mengelola dan melakukan presensi.</li>
                                <li>"Instansi Pendidikan" adalah lembaga pendidikan formal atau nonformal yangmenyelenggarakan
                                    pendidikan.</li>
                                <li>"Aktor Presensi" adalah staff, guru, dan peserta didik yang melakukan presensi menggunakan
                                    Platform HadirAja.</li>
                                <li>"Paket Trial" adalah paket layanan Platform HadirAja yang diberikan secara gratis selama 30
                                    hari dengan jumlah penggunaan 300 pengguna.</li>
                            </ul>
    
                            <h2>2. Ketentuan Umum</h2>
    
                            <p>
                            <ul>
                                <li>Paket Trial hanya dapat diakses oleh Institusi Pendidikan yang belum pernah berlangganan
                                    Platform HadirAja.</li>
                                <li>Paket Trial hanya dapat digunakan untuk 300 Aktor Presensi.</li>
                                <li>Paket Trial tidak dapat diperpanjang.</li>
                            </ul>
                            </p>
    
                            <h2>3. Hak dan Kewajiban Pengguna</h2>
    
                            <p>
                            <ul>
                                <li>Pengguna berhak menggunakan Platform HadirAja selama masa berlaku Paket Trial.</li>
                                <li>Pengguna wajib mematuhi ketentuan yang berlaku dalam Platform HadirAja.</li>
                                <li>Pengguna bertanggung jawab atas data yang dimasukkan ke dalam Platform HadirAja.</li>
                            </ul>
                            </p>
    
                            <h2>4. Hak dan Kewajiban Platform HadirAja</h2>
    
                            <p>
                            <ul>
                                <li>Platform HadirAja berhak untuk mengubah, menangguhkan, atau menghentikan penyediaan Platform
                                    HadirAja sewaktu-waktu.</li>
                                <li>Platform HadirAja berhak untuk menghapus data pengguna yang melanggar ketentuan yang
                                    berlaku.
                                </li>
                            </ul>
                            </p>
    
                            <h2>5. Larangan</h2>
    
                            <p>Pengguna dilarang untuk:</p>
    
                            <ul>
                                <li>Menggunakan Platform HadirAja untuk tujuan yang melanggar hukum atau peraturan yang berlaku.
                                </li>
                                <li>Melakukan penyalahgunaan data yang diperoleh dari Platform HadirAja.</li>
                                <li>Melakukan perubahan atau modifikasi terhadap Platform HadirAja tanpa izin dari [Nama
                                    Perusahaan].</li>
                            </ul>
    
                            <h2>6. Penyelesaian Sengketa</h2>
    
                            <p>Segala perselisihan yang timbul antara Pengguna dan Platform HadirAja akan diselesaikan secara
                                musyawarah untuk mufakat. Jika tidak dapat diselesaikan secara musyawarah, maka perselisihan
                                tersebut akan diselesaikan melalui pengadilan yang berwenang.</p>
    
                            <h2>7. Ketentuan Lain</h2>
    
                            <p>
                            <ul>
                                <li>Platform HadirAja berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu.</li>
                                <li>Ketentuan yang berlaku dalam syarat dan ketentuan ini merupakan bagian yang tidak
                                    terpisahkan
                                    dari Perjanjian Penggunaan Platform HadirAja.</li>
                                <li>Dengan menggunakan Platform HadirAja, Pengguna dianggap telah menyetujui syarat dan
                                    ketentuan
                                    ini.</li>
                            </ul>
                            </p>
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Saya Setuju</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection
