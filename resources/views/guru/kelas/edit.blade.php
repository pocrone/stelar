@extends('guru.layouts.master')

@section('title', 'Edit Kelas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Ubah kelas
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update_class') }}" class="form-inline">
                        @csrf
                        @error('class_name')
                            {{ $message }}
                        @enderror
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary">Nama Kelas</div>
                            </div>
                            <input type="text" class="form-control" name='class_name' id="inlineFormInputGroupUsername2"
                                value="{{ $classroom->class_name }}" placeholder="Masukkan Nama Kelas" />
                        </div>
                        <input type="hidden" name="id" value="{{ $classroom->id }}">
                        <div class="input-group mb-2 mr-sm-2">
                            <button type="submit" class="btn btn-primary btn-md"> Simpan </button>
                        </div>
                    </form>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hapusKelas">
                        Hapus Kelas
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusKelas" tabindex="-1" role="dialog" aria-labelledby="hapusKelasLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusKelasLabel">Hapus Kelas {{ $classroom->class_name }}?
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Seluruh data kelas termasuk materi, tugas, dan rekap nilai siswa akan terhapus secara
                                    permanen
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="{{ route('delete_class', ['id' => $classroom->id]) }}"
                                        class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
