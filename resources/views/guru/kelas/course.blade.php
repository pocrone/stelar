@extends('guru.layouts.master')

@section('title', 'Lihat Kelas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
        </ol>
    </nav>
    <div class="row">

        <div class="col-md-6"> nama kelas {{ $course->class_name }}
        </div>
        <div class="col-md-6">
            jumlah siswa {{ $jumlah_siswa }}
            <a href="">Daftar nama siswa</a>
        </div>
        <div class="col-md-6"> kode kelas {{ $course->class_code }}</div>

        <div class="col-md-6"> Jumlah kelompok
            <a href="">Daftar kelompok</a>
        </div>

        <div class="col-md-6">jumlah materi
            <a href="{{ route('lessons', [$course->id]) }}">Manajemen materi</a>
        </div>

        <div class="col-md-6">jumlah tugas
            <a href="">Manajemen tugas</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('edit_class', ['id' => $course->id]) }}">Pengaturan Kelas</a>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    MATERI
                </div>
                <div class="card-body">
                    <a href="{{ route('create_lesson', ['id' => $id]) }}" class="btn btn-primary">Buat
                        materi</a>
                    <hr>
                    @foreach ($lessons as $row)
                        <div class="row">
                            <a
                                href="{{ route('show_lesson', ['classroom_id' => $row->classroom_id, 'lesson_id' => $row->id]) }}">{{ $row->title }}</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    TUGAS
                </div>
                <div class="card-body">
                    <a href="{{ route('create_assignment', ['classroom_id' => $id]) }}" class="btn btn-primary">Buat
                        Tugas</a>
                    <hr>
                    @foreach ($assignments as $row)
                        <div class="row">
                            <a
                                href="{{ route('show_assignment', ['classroom_id' => $row->classroom_id, 'assignment_id' => $row->id]) }}">{{ $row->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
