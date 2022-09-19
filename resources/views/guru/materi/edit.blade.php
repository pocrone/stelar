@extends('guru.layouts.master')

@section('title', 'Edit Materi')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header">Edit Materi</div>
            <div class="card-body">
                <form method="post" action="{{ route('update_lesson', ['lesson_id' => $lesson->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @error('class_name')
                        {{ $message }}
                    @enderror
                    <div class="form-group">
                        <label for="title">Judul Materi</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul materi" name="title"
                            value="{{ $lesson->title }}">
                    </div>
                    <div class="form-group">
                        <label for="attachment">Lampiran (Opsional)</label>
                        @if ($lesson->attachment != '')
                            <p> <a href="{{ route('download_lesson', ['lesson_id' => $lesson->id]) }}">Download lampiran</a>
                            </p>
                            <span class="btn btn-info" id="edit_attachment">Edit lampiran</span>
                            <a class="btn btn-danger"
                                href="{{ route('delete_attachment', ['lesson_id' => $lesson->id]) }}">Hapus lampiran</a>
                            <div id="file-input" style="display: none">
                                <input type="file" class="form-control" id="attachment" name="attachment">
                            </div>
                        @else
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="content">Isi Materi</label>
                        <textarea class="form-control" id="content" name="content" rows="">{{ $lesson->content }}</textarea>
                    </div>
                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                    <input type="submit" class="btn btn-primary btn-lg" value="Simpan">
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
