@extends('siswa.layouts.master')

@section('title', 'Siswa | Detail Kelas')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title">Materi</h5>

                    <a href="#" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title">Tugas</h5>
                    <a href="#" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>

    </div>
@endsection
