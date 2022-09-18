@extends('guru.layouts.master')

@section('title', 'Lihat Tugas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-2">
            @if ($assignment->attachment != '')
                <div class="card w-100 mb-3">
                    <div class="card-header">Lampiran</div>
                    <div class="card-body">
                        <a class="btn btn-primary"
                            href="{{ route('download_assignment', ['assignment_id' => $assignment->id]) }}">Download
                        </a>
                    </div>

                </div>
            @endif
            <a class="btn btn-primary btn-lg mb-3 w-100"
                href="{{ route('edit_assignment', ['assignment_id' => $assignment->id]) }}">Edit
            </a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-lg w-100" data-toggle="modal" data-target="#deleteassignment">
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
        <div class="col-md-10">
            <div class="card w-100">
                <div class="card-header">{{ $assignment->title }}</div>
                <div class="card-body">


                    {!! $assignment->content !!}
                </div>
            </div>
        </div>

    </div>





@endsection
