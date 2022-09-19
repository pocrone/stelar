@extends('siswa.layouts.master')

@section('title', 'Dashboard Siswa')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <span class="h2">Selamat Datang {{ $nama }}</span>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($classroom->id == null or $classroom->id == '')
            <div class="col-md-12">
                <div class="card w-100">
                    <div class="vector my-3">
                        <h4> Anda belum masuk kelas
                        </h4>
                        <img src="{{ asset('assets/images/vector/No.svg') }}" alt="" srcset="">
                        <a href="{{ route('std_list_class') }}" class="btn btn-primary btn-lg">Bergabung ke Kelas</a>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="card card-banner">
                    <span class="small">Kelas</span>
                    <span class="h1"> {{ $classroom->class_name }}</span>
                    <span class="small">Pengajar</span>
                    <span class="h1"> {{ $teacher }}</span>
                    <a href="{{ route('std_classdetail') }}" class="btn btn-danger btn-lg">Lihat
                        Kelas</a>
                </div>
            </div>
            @if ($user_group_status == true)
                <div class="col-md-6">
                    <div class="card card-banner">
                        <span class="small">Perusahaan Anda</span>
                        <span class="h1">{{ $group->groupname }}</span>
                        <a href="{{ route('join_company') }}" class="btn btn-primary btn-lg">Lihat Perusahaan</a>

                    </div>
                </div>
                <span class="col-md-12 mt-4 h3">Kelola Surat</span>
                <div class="col-sm-4 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body p-4">
                            <img class="img-fluid w-100" src="{{ asset('assets/images/dashboard/leader.svg') }}"
                                alt="" />
                        </div>
                        <div class="card-body px-3 text-dark">

                            <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Pimpinan</span>
                            </h5>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    Bertugas untuk membuat konsep dan mengkoreksi surat keluar dan melakukan
                                    tanda tangan pada surat
                                    keluar
                                </p>

                            </div>
                            <a href="{{ route('leaderdashboard') }}"
                                class='btn btn-primary btn-sm btn-block mt-2 '>Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 stretch-card grid-margin">
                    <div class="card ">
                        <div class="card-body p-4">
                            <img class="img-fluid w-60" src="{{ asset('assets/images/dashboard/secretary.svg') }}"
                                alt="" />
                        </div>
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Sekretaris</span>
                            </h5>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    Bertugas melakukan melakukan
                                    manajemen surat masuk dan membuat surat keluar sesuai dengan konsep surat yang telah
                                    dibuat pimpinan sebelumnya
                                </p>
                            </div>
                            <a href="{{ route('secretary_dashboard') }}"
                                class='btn btn-primary btn-sm btn-block mt-2 '>Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body p-4">
                            <img class="img-fluid w-100" src="{{ asset('assets/images/dashboard/archivist.svg') }}"
                                alt="" />
                        </div>
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Arsiparis</span>
                            </h5>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    Bertugas untuk melakukan
                                    manajemen surat masuk dan surat keluar serta melakukan pengolahan
                                    retensi surat
                                </p>

                            </div>
                            <a href="{{ route('secretary_dashboard') }}"
                                class='btn btn-primary btn-sm btn-block mt-2'>Masuk</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card w-100">
                        <div class="vector my-3">
                            <h4> Anda belum masuk perusahaan
                            </h4>
                            <img src="{{ asset('assets/images/vector/No.svg') }}" alt="" srcset="">
                            <a href="{{ route('join_company') }}" class="btn btn-primary btn-lg">Bergabung ke
                                Perusahaan</a>
                        </div>
                    </div>
                </div>
            @endif

        @endif

        {{-- <div class="col-xl-6 stretch-card grid-margin">
            <div class="card card-img">
                <div class="card-body d-flex align-items-center">
                    <div class="text-white">
                        <h2 class=" font-weight-semibold "> Masuk Kelas </h2>

                        <p class="font-15 font-weight-semibold"> Anda dapat melihat informasi kelas dan lihat tugas terbaru
                            yang harus kamu kerjakan </p>
                        <a href="{{ route('std_list_class') }}" class="btn bg-white font-12">Masuk Kelas</a>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
    {{-- <div class="row">
        <div class="col-xl-6 stretch-card grid-margin">
            <div class="card card-stat">
                <div class="card-body d-flex align-items-center">
                    <div class="text-white">
                        <h2 class=" font-weight-semibold "> Kelola Purusahaan / Kelompokmu </h2>

                        <p class="font-15 font-weight-semibold"> Anda dapat melihat informasi perusahaan / kelompok kamu
                            disini </p>
                        <a href="{{ route('join_company') }}" class="btn bg-white font-12">Kelola Perusahaan</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="row">
        <div class="col-sm-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body p-4">
                    <img class="img-fluid w-100" src="{{ asset('assets/images/dashboard/leader.svg') }}" alt="" />
                </div>
                <div class="card-body px-3 text-dark">

                    <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Pimpinan</span> </h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                        <p class="mb-0">
                            Bertugas untuk membuat konsep dan mengkoreksi surat keluar dan melakukan
                            tanda tangan pada surat
                            keluar
                        </p>

                    </div>
                    <a href="{{ route('leaderdashboard') }}" class='btn btn-primary btn-sm btn-block mt-2 '>Masuk</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 stretch-card grid-margin">
            <div class="card ">
                <div class="card-body p-4">
                    <img class="img-fluid w-60" src="{{ asset('assets/images/dashboard/secretary.svg') }}" alt="" />
                </div>
                <div class="card-body px-3 text-dark">
                    <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Sekretaris</span> </h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                        <p class="mb-0">
                            Bertugas melakukan melakukan
                            manajemen surat masuk dan membuat surat keluar sesuai dengan konsep surat yang telah
                            dibuat pimpinan sebelumnya
                        </p>
                    </div>
                    <a href="{{ route('secretary_dashboard') }}" class='btn btn-primary btn-sm btn-block mt-2 '>Masuk</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body p-4">
                    <img class="img-fluid w-100" src="{{ asset('assets/images/dashboard/archivist.svg') }}"
                        alt="" />
                </div>
                <div class="card-body px-3 text-dark">
                    <h5 class="font-weight-semibold">Masuk sebagai <span class="text-primary">Arsiparis</span> </h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                        <p class="mb-0">
                            Bertugas untuk melakukan
                            manajemen surat masuk dan surat keluar serta melakukan pengolahan
                            retensi surat
                        </p>

                    </div>
                    <a href="{{ route('archivist_dashboard') }}" class='btn btn-primary btn-sm btn-block mt-2'>Masuk</a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

<!-- content-wrapper ends -->
