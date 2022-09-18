@extends('guru.layouts.master')

@section('title', 'Edit Kelas')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="vector">
                <img src="{{ asset('assets/images/vector/Schedule.svg') }}" alt="" srcset="">

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body text-center p-5 my-5">
                    <form method="post" action="{{ route('update_class') }}">
                        @csrf
                        @error('class_name')
                            {{ $message }}
                        @enderror
                        <h3 class="mb-3">Ubah Nama Kelas</h3>
                        <input type="text" class="form-control big-input mb-3" name='class_name'
                            id="inlineFormInputGroupUsername2" value="{{ $classroom->class_name }}"
                            placeholder="Masukkan Nama Kelas" />
                        <button type="submit" class="btn btn-primary btn-lg"> Simpan </button>
                        <input type="hidden" name="id" value="{{ $id }}">
                    </form>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#hapusKelas">
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
