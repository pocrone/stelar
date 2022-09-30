@extends('siswa.layouts.master')

@section('title', 'Siswa | Pengaturan Akun ')

@section('navbar')

@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="content text-center col-md-8 mx-auto">
                    <div class="logo mb-0">
                        <h3>Edit Akun User</h3>
                        <img src="{{ asset('storage/avatar/' . $user->avatar) }}" style="width: 100px;" alt="accountphoto"
                            class="img-fluid mb-4">


                    </div>
                    <div class="title-text">

                        @error('email')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror
                        @error('name')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror
                        @error('file')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror

                    </div>

                    <form action="{{ route('user_update_data') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <!-- Username -->
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="name" name="name" class="form-control" id="inputEmail3"
                                    placeholder="Masukkan Nama" value="{{ $user->name }}">
                            </div>
                        </div>

                        <!-- Email -->
                        {{-- <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3"
                                    placeholder="Email" value="{{ $user->email }}">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name='file' class="form-control">
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="inputEmail3"
                                    placeholder="Password" value="**********" readonly>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-md btn-primary text-left mr-4">Submit</button>
                        <a href="{{ route('user_setting_password') }}" class="btn btn-md btn-danger text-left mr-4">Ubah
                            Password</a>



                        <!-- Submit Button -->

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
