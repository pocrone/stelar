@extends('siswa.layouts.master')

@section('title', 'Lihat Tugas')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-2">
            @if ($assignment->attachment != '')
                <div class="card w-100 mb-3">
                    <div class="card-header card-amplop">Lampiran</div>
                    <div class="card-body">
                        <a class="btn btn-primary"
                            href="{{ route('download_tugas', ['id_tugas' => $assignment->id]) }}">Download
                        </a>
                    </div>

                </div>
            @endif



        </div>
        <div class="col-md-10">
            <div class="card w-100 mt-4">
                <div class="card-body">
                    <h5 class="text-center mx-auto"> <label class='badge badge-primary mr-3'>Hasil Pekerjaaan </label>
                    </h5>
                    <hr>
                    <table>
                        <tr>
                            <td class="col-2">
                                <h6 class="text-bold">Nilai Kelompok</h6>
                            </td>

                            <td class="col-6">
                                <h6>199</h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-2">
                                <h6 class="text-bold">Komentar</h6>
                            </td>

                            <td class="col-6">
                                <p> lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem </p>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="card w-100">
                <div class="card-body">
                    <h5> <label class='badge badge-secondary mr-3'>Judul Tugas :</label>{{ $assignment->title }}</h5>
                    <hr>
                    <p> <label class='badge badge-secondary'>Deskripsi Tugas</label> </p>
                    {!! $assignment->content !!}
                </div>
            </div>

        </div>


    </div>





@endsection
