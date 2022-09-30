@extends('siswa.layouts.master')

@section('title', 'Siswa | Pengaturan Akun ')

@section('navbar')

@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="content text-center col-md-8 mx-auto">
                    <div class="logo mb-4">
                        <h3>Edit Password User</h3>

                    </div>
                    <div class="title-text">
                        @if ($message = Session::get('gagal'))
                            <small><span class="text-danger">{{ $message }}</span></small>
                        @endif
                        @if ($message = Session::get('success'))
                            <small><span class="text-danger">{{ $message }}</span></small>
                        @endif
                        @error('old_password')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror
                        @error('password')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror
                        @error('password_confirmation')
                            <small><span class="text-danger">{{ $errors->first() }}</span></small>
                        @enderror

                    </div>

                    <form action="{{ route('edit_setting_password') }}" method="POST">
                        @csrf
                        <!-- Username -->

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Password Lama</label>
                            <div class="col-sm-9">
                                <input type="password" name='old_password' class="form-control" id="inputEmail3"
                                    placeholder="Password">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" name='password' class="form-control" id="inputEmail3"
                                    placeholder="Password">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-9">
                                <input type="password" name='password_confirmation' class="form-control" id="inputEmail3"
                                    placeholder="Password">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-md btn-primary text-left ">Submit</button>




                        <!-- Submit Button -->

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
