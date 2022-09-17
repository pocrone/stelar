@extends('guru.layouts.master')

@section('title', 'Edit Tugas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('course', ['id' => $id]) }}">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Tugas</li>
        </ol>
    </nav>
    <div class="row">
        <div class="card w-100">
            <div class="card-header">Edit Tugas</div>
            <div class="card-body">
                <form method="post" action="{{ route('update_assignment', ['assignment_id' => $assignment->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @error('title')
                        {{ $message }}
                    @enderror
                    <div class="form-group">
                        <label for="title">Judul Tugas</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul materi" name="title"
                            value="{{ $assignment->title }}">
                    </div>
                    <div class="form-group">
                        <label for="attachment">Lampiran (Opsional)</label>
                        @if ($assignment->attachment != '')
                            <p> <a href="{{ route('download_assignment', ['assignment_id' => $assignment->id]) }}">Download
                                    lampiran</a>
                            </p>
                            <span class="btn btn-info" id="edit_attachment">Edit lampiran</span>
                            <a class="btn btn-danger"
                                href="{{ route('delete_attachment_asg', ['assignment_id' => $assignment->id]) }}">Hapus
                                lampiran</a>
                            <div id="file-input" style="display: none">
                                <input type="file" class="form-control" id="attachment" name="attachment">
                            </div>
                        @else
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="content">Isi Tugas</label>
                        <textarea class="form-control" id="content" name="content" rows="">{{ $assignment->content }}</textarea>
                    </div>
                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                    <input type="submit" value="Simpan">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                'height': '200',
            });
            $('#edit_attachment').click(function() {
                $('#file-input').toggle()
            });

        });
    </script>
@endsection
