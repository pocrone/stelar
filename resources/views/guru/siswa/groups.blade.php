@extends('guru.layouts.master')

@section('title', 'Data Siswa')

@section('navbar')
    @include('guru.layouts.gate-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header">Data Kelompok Kelas {{ $class_name }}</div>
            <div class="card-body">
                @if ($count_students == 0)
                    <div class="vector">
                        <img src="{{ asset('assets/images/vector/Match.svg') }}" alt="" srcset="">
                        Belum ada kelompok
                    </div>
                @else
                    <table class="table table-bordered w-100" id="groups-table">
                        <thead>
                            <th>No.</th>
                            <th>Nama Kelompok</th>
                            <th>Ketua</th>
                            <th>Jumlah Anggota</th>
                            <th></th>
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
            $('#groups-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('groups', ['classroom_id' => $id]) !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'groupname',
                        name: 'groupname'
                    },
                    {
                        data: 'name',
                        name: 'leader'
                    },
                    {
                        data: 'count',
                        name: 'count',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                    },
                ],

            });
        });
    </script>
@endsection
