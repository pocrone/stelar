@extends('siswa.layouts.master')

@section('title', 'Pimpinan | Dashboard')

@section('navbar')
    @include('siswa.layouts.leader-sidebar')
@stop

@section('content')
    <h4 class="font-weight-bold">Welcome Pimpinan Hafizh</h4>
    <hr>
    <div class="row mt-4 ">
        <div class="col-xl-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-auto p-4">
                        <img src="{{ asset('assets/images/file-icons/256/005-database.png') }}" class="img-fluid"
                            width="75" alt="">
                    </div>
                    <div class="col">
                        <div class="card-block px-2 py-4">
                            <h1 class="card-title">25</h1>
                            <hr>
                            <p class="card-text">Konsep Surat</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-auto p-4">
                        <img src="{{ asset('assets/images/file-icons/256/006-record.png') }}" class="img-fluid"
                            width="75" alt="">
                    </div>
                    <div class="col">
                        <div class="carixzzZxsdzvccxzxz321`121`11`112321`d-block px-2 py-4">
                            <h1 class="card-title">33</h1>
                            <hr>
                            <p class="card-text">Surat Keluar Belum Terkoreksi</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-auto p-4">
                        <img src="{{ asset('assets/images/file-icons/256/003-interface.png') }}" class="img-fluid"
                            width="75" alt="">
                    </div>
                    <div class="col">
                        <div class="card-block px-2 py-4">
                            <h1 class="card-title">47</h1>
                            <hr>
                            <p class="card-text">Surat Keluar Belum TTD</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
