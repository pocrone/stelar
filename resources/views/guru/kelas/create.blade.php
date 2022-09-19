@extends('guru.layouts.master')

@section('title', 'Buat Kelas')

@section('navbar')
    @include('guru.layouts.home-sidebar')
@stop

@section('content')
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="vector">
                <img src="{{ asset('assets/images/vector/Schedule.svg') }}" alt="" srcset="">

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body text-center p-5 my-5">
                    <h3 class="mb-3"> Tambahkan Kelas Baru</h3>
                    <form method="post" action="{{ route('store_class') }}">
                        @csrf
                        @error('class_name')
                            {{ $message }}
                        @enderror
                        <input type="text" class="form-control big-input mb-3" name='class_name' id="class_name"
                            placeholder="Masukkan Nama Kelas" />

                        <button type="submit" class="btn btn-primary btn-lg"> Buat Kelas </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
