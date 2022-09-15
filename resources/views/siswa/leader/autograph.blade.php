@extends('siswa.layouts.master')

@section('title', 'Pimpinan | Upload TTD')

@section('navbar')
    @include('siswa.layouts.leader-sidebar')
@stop

@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Tanda Tangan Pimpinan</p>
                <hr>
                {{-- <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Kamu belum mengupload TTD</strong>
                </div> --}}
                <div class="col-12 text-center">
                    @if (empty($autograph))
                        <img class="img-fluid mb-3" src="{{ asset('assets/images/ttd/default_sign.png') }}" alt=""
                            width="80%">
                    @else
                        <img class="img-fluid mb-3" src="{{ asset('storage/autograph/' . $autograph->autograph) }}"
                            alt="" width="80%">
                    @endif

                </div>
                <button type="button" data-toggle="modal" data-target="#ttd" class="btn-block btn btn-sm btn-primary">Ubah
                    / Upload
                    Tanda Tangan</button>
            </div>

        </div>

    </div>

    <div class="modal fade" id="ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload TTD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('store_autograph') }}" enctype="multipart/form-data">
                        @csrf
                        Masukkan Foto TTD
                        <input type="file" name="file">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
