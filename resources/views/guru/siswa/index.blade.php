@extends('guru.layouts.master')

@section('title', 'Data Siswa')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('course', ['id' => $id]) }}">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Siswa Kelas {{ $class_name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="card w-100">
            <div class="card-header">Data Siswa Kelas {{ $class_name }}</div>
            <div class="card-body">
                @if ($count_students == 0)
                    Belum ada siswa yang bergabung
                @else
                    <table class="table table-bordered w-100" id="students-table">
                        <thead>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>E-mail</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>





@endsection
@section('customjs')
    <script>
        $(function() {
            $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('students', ['classroom_id' => $id]) !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                    },
                ],
                order: [
                    [1, 'asc']
                ],
            });
        });
    </script>
@endsection
