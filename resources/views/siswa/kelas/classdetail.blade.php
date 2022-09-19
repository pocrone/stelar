@extends('siswa.layouts.master')

@section('title', 'Siswa | Detail Kelas')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 text-center h3">
                Kelas {{ $classroom->class_name }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header card-amplop">Materi</div>
                <div class="card-body">
                    <table class="table">
                        @forelse ($lessons as $row)
                            <td>
                                <a href="{{ route('materi', $row->id) }}" class="mb-3 h5">{{ $row->title }}</a>
                            </td>
                        @empty
                            <div class="vector my-3">

                                <img src="{{ asset('assets/images/vector/No.svg') }}" alt="" srcset="">
                                <h4>Belum ada materi
                                </h4>
                            </div>
                        @endforelse

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header card-amplop">Tugas</div>
                <div class="card-body">
                    <table class="table">
                        @forelse ($assignments as $row)
                            <tr>
                                <td>
                                    <a href="{{ route('tugas', $row->id) }}" class="mb-3 h5">{{ $row->title }}</a>
                                </td>
                            </tr>
                        @empty
                            <div class="vector my-3">

                                <img src="{{ asset('assets/images/vector/No.svg') }}" alt="" srcset="">
                                <h4>Belum ada tugas
                                </h4>
                            </div>
                        @endforelse

                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
