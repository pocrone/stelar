@extends('guru.layouts.master')

@section('title', 'Buat Tugas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header">Buat Tugas</div>
            <div class="card-body">
                <form method="post" action="{{ route('insert_assignment') }}" enctype="multipart/form-data">
                    @csrf
                    @error('title')
                        {{ $message }}
                    @enderror
                    <div class="form-group">
                        <label for="title">Judul Tugas</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul tugas" name="title">
                    </div>
                    <div class="form-group">
                        <label for="attachment">Lampiran (Opsional)</label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Tugas</label>
                        <textarea class="form-control" id="content" name="content" rows=""></textarea>
                    </div>
                    <input type="hidden" name="classroom_id" value="{{ $id }}">

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
        });
    </script>
@endsection
