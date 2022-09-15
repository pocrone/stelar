@extends('siswa.layouts.master')

@section('title', 'Siswa | Daftar Kelas')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')
    <div class="container">
        @if ($status == '0')
            <div class="card">
                <div class="card-body ">
                    <div class="text-center">
                        @if ($message = Session::get('gagal'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @error('class_code')
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <center>
                            <h3 class="mb-3">Maaf kamu belum mengikuti kelas apapun </h3>
                        </center>
                        <img src="{{ asset('assets/images/dashboard/cancel.svg') }}" width="20%" class="mb-4">

                        <form action="{{ route('join_class') }}" method="post">
                            @csrf
                            <div class="form-group row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control " name="class_code" id=""
                                        placeholder="Masukkan Kode Kelas">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary btn-md btn-block" value="Submit"
                                        id="">
                                </div>

                            </div>
                        </form>
                    </div>


                </div>
            </div>
        @else
            <div class="card w-25 mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $class->class_name }}</h5>
                    <p class="card-text">Kode kelas : {{ $class->class_code }}</p>
                    <div class="row">
                        <a href="{{ route('std_classdetail', $class->id) }}" class="btn btn-primary btn-sm">Masuk</a>
                        <a href="{{ route('std_exitclass', $class->id) }}" class="btn btn-danger btn-sm">Keluar</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="addKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Kelas Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_kelas" method="post">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Masukkan Nama Kelas</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="inp_klasifikasi"
                                    placeholder="Masukkan Nama Kelas" name='class_name'>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
