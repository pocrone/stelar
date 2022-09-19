@extends('siswa.layouts.master')

@section('title', 'Lihat Materi')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-2">
            @if ($lesson->attachment != '')
                <div class="card w-100 mb-3">
                    <div class="card-header card-amplop">Lampiran</div>
                    <div class="card-body">
                        <a class="btn btn-primary"
                            href="{{ route('download_materi', ['id_materi' => $lesson->id]) }}">Download
                        </a>
                    </div>

                </div>
            @endif



        </div>
        <div class="col-md-10">
            <div class="card w-100">
                <div class="card-body">
                    <h5>{{ $lesson->title }}</h5>
                    {!! $lesson->content !!}
                </div>
            </div>
        </div>


    </div>





@endsection
