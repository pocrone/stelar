@extends('guru.layouts.master')

@section('title', 'Buat Materi')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header">Buat Materi</div>
            <div class="card-body">
                <form method="post" action="{{ route('insert_lesson') }}" enctype="multipart/form-data">
                    @csrf
                    @error('class_name')
                        {{ $message }}
                    @enderror
                    <div class="form-group">
                        <label for="title">Judul Materi</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul materi" name="title">
                    </div>
                    <div class="form-group">
                        <label for="attachment">Lampiran (Opsional)</label>
                        <input type="file" class="form-control" id="attachment" placeholder="Upload File"
                            name="attachment">
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Materi</label>
                        <textarea class="form-control" id="content" name="content" rows=""></textarea>
                    </div>
                    <input type="hidden" name="classroom_id" value="{{ $id }}">

                    <input type="submit" value="Simpan" class="btn btn-primary btn-lg">
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
        });
    </script>
@endsection
