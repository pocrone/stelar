@extends('guru.layouts.master')

@section('title', 'Lihat Materi')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('course', ['id' => $id]) }}">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lihat Materi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-2">
            @if ($assignment->attachment != '')
                <div class="card w-100">
                    <div class="card-header">Download lampiran</div>
                    <div class="card-body">
                        <a href="{{ route('download_assignment', ['assignment_id' => $assignment->id]) }}">Download
                            lampiran</a>
                    </div>

                </div>
            @endif
            <div class="card">
                <a href="{{ route('edit_assignment', ['assignment_id' => $assignment->id]) }}">EDIT</a>
            </div>
            <div class="card">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteassignment">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteassignment" tabindex="-1" role="dialog"
                    aria-labelledby="deleteassignmentLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteassignmentLabel">Hapus Tugas {{ $assignment->title }}?
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Tugas {{ $assignment->title }} akan dihapus secara
                                permanen
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <a href="{{ route('delete_assignment', ['assignment_id' => $assignment->id]) }}"
                                    class="btn btn-primary">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card w-100">
                <div class="card-header">{{ $assignment->title }}</div>
                <div class="card-body">
                    @if ($assignment->updated_at == '')
                        <p>DIBUAT TANGGAL {{ $assignment->created_at }}</p>
                    @else
                        <p>DIPERBARUI TANGGAL {{ $assignment->updated_at }}</p>
                    @endif

                    {!! $assignment->content !!}
                </div>
            </div>
        </div>

    </div>





@endsection
