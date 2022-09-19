@extends('guru.layouts.master')

@section('title', 'Lihat Materi')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-2">
            @if ($lesson->attachment != '')
                <div class="card w-100 mb-3">
                    <div class="card-header">Lampiran</div>
                    <div class="card-body">
                        <a class="btn btn-primary"
                            href="{{ route('download_lesson', ['lesson_id' => $lesson->id]) }}">Download</a>
                    </div>

                </div>
            @endif
            <a class="btn btn-primary btn-lg form-control mb-3"
                href="{{ route('edit_lesson', ['lesson_id' => $lesson->id]) }}">

                Edit</a>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-lg form-control" data-toggle="modal"
                data-target="#deleteLesson">
                Hapus
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteLesson" tabindex="-1" role="dialog" aria-labelledby="deleteLessonLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteLessonLabel">Hapus Materi {{ $lesson->title }}?
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Materi {{ $lesson->title }} akan dihapus secara
                            permanen
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="{{ route('delete_lesson', ['lesson_id' => $lesson->id]) }}"
                                class="btn btn-primary">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card w-100">
                <div class="card-header">{{ $lesson->title }}</div>
                <div class="card-body">
                    {!! $lesson->content !!}
                </div>
            </div>
        </div>

    </div>





@endsection
