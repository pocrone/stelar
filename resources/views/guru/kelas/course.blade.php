@extends('guru.layouts.master')

@section('title', 'Lihat Kelas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="card card-banner">
                <span class="small">Kode Kelas</span>
                <span class="h1"> {{ $course->class_code }}</span>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-banner">
                <span class="small">Siswa</span>
                <span class="h1">{{ $jumlah_siswa }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-banner">
                <span class="small">Materi</span>
                <span class="h1">{{ $count_lesson }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-banner">
                <span class="small">Tugas</span>
                <span class="h1">{{ $count_assignments }}</span>
            </div>
        </div>


    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Materi
                </div>
                <div class="card-body">
                    <a href="{{ route('create_lesson', ['id' => $id]) }}" class="btn btn-primary text-center">
                        <i class="mdi mdi-plus menu-icon"></i>
                        Tambah Materi
                    </a>
                    <hr>
                    @forelse ($lessons as $row)
                        <div class="d-block mb-3">
                            <a class="text-black"
                                href="{{ route('show_lesson', ['classroom_id' => $row->classroom_id, 'lesson_id' => $row->id]) }}">
                                <i class="mdi mdi-book menu-icon"></i>
                                {{ $row->title }}
                                <i class="mdi mdi-chevron-triple-right menu-icon"></i>
                            </a>
                        </div>
                    @empty
                        <div class="vector">
                            <img src="{{ asset('assets/images/vector/Match.svg') }}" alt="" srcset="">
                            Tidak ada materi
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tugas
                </div>
                <div class="card-body">
                    <a href="{{ route('create_assignment', ['classroom_id' => $id]) }}" class="btn btn-primary">
                        <i class="mdi mdi-plus menu-icon"></i>

                        Tambah
                        Tugas</a>
                    <hr>
                    @forelse ($assignments as $row)
                        <div class="d-block mb-3">
                            <a class="text-black"
                                href="{{ route('show_assignment', ['classroom_id' => $row->classroom_id, 'assignment_id' => $row->id]) }}">
                                <i class="mdi mdi-bookmark-multiple menu-icon"></i>

                                {{ $row->title }}
                                <i class="mdi mdi-chevron-triple-right menu-icon"></i>
                            </a>
                        </div>
                    @empty
                        <div class="vector">
                            <img src="{{ asset('assets/images/vector/Match.svg') }}" alt="" srcset="">
                            Tidak ada tugas
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


@endsection
