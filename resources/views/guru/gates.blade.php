@extends('guru.layouts.master')

@section('title', 'Beranda')

@section('navbar')
    @include('guru.layouts.home-sidebar')
@stop

@section('content')


    <div class="row">
        <div class="col-xl-3  ">
            <div class="card card-basic">
                <div class="card-body d-flex align-items-center">
                    <div class="text-white">
                        <h2 class=" font-weight-semibold ">Buat Kelas baru</h2>

                        <p class="font-15 font-weight-semibold">Buat kelas untuk mulai mengajar </p>
                        <a href="{{ route('create_class') }}" class="btn bg-white font-12">Buat Kelas</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 stretch-card grid-margin">
            <div class="card">
                <div class="card-body ">
                    <h4 class="mb-4">Kelas Saya</h4>
                    <div class="row">

                        @forelse ($classroom as $row)
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('course', ['id' => $row->id]) }}">
                                    <div class="card card-link">

                                        <p> <img class="icons mr-2"
                                                src="{{ asset('assets/images/icons/icons8-schedule-16.png') }}"
                                                alt="" srcset="">{{ $row->class_code }}</p>
                                        {{ $row->class_name }}
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="vector">

                                <img src="{{ asset('assets/images/vector/No.svg') }}" alt="" srcset="">
                                <h4> Belum ada kelas
                                </h4>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

<!-- content-wrapper ends -->
