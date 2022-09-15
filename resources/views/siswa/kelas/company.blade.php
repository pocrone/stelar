@extends('siswa.layouts.master')

@section('title', 'Management Company')

@section('navbar')
    @include('siswa.layouts.gate-sidebar')
@stop

@section('content')

    <div class="card">
        <div class="card-body ">
            @if ($message = Session::get('success'))
                <div class="alert alert-primary alert-block text-center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('warn'))
                <div class="alert alert-warning alert-block text-center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (empty($data))
                <div class="text-center">
                    <center>
                        <h3 class="mb-3">Maaf kamu belum mengikuti perusahaan/kelompok apapun </h3>
                    </center>
                    <img src="{{ asset('assets/images/dashboard/notfound.svg') }}" width="30%" class="mb-4">
                </div>
            @else
                <h3>Detail Kelompok</h3>
                <hr>
                <div class="col-md-4">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Kelompok/Perusahaan :</th>
                            <td>{{ $data['info']['groupname'] }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ketua :</th>
                            <td>{{ $data['info']['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Anggota :</th>
                            <td>{{ $data['info']['total'] }} / 4</td>
                        </tr>

                    </table>
                </div>
            @endif



        </div>
    </div>


    <div class="card mt-3">

        <div class="card-body">
            @if (empty($data))
                <h4 class="card-title card-header d-flex justify-content-between align-items-center">
                    Daftar Kelompok
                    <button type="button" data-toggle="modal" data-target="#addKelompok"
                        class="btn btn-primary btn-icon-text">
                        Add Data </button>
                </h4>
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kelompok</th>
                                <th>Ketua.</th>
                                <th>Jumlah Anggota</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            @else
                <h4 class="card-title card-header d-flex justify-content-between align-items-center">
                    Daftar Anggota </h4>
                <div class="table-responsive">
                    <table class="table table-anggota">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        ?>
                        <tbody>
                            @foreach ($data['member'] as $row)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $row['name'] }}</td>

                                    @if ($row['user_id'] == $data['info']['LeaderGroupID'])
                                        <td class="text-bold">
                                            {{ 'Ketua' }}
                                        </td>
                                    @else
                                        <td>
                                            {{ 'Anggota' }}
                                        </td>
                                    @endif
                                    @if ($data['userID'] == $data['info']['LeaderGroupID'])
                                        @if ($row['user_id'] != $data['info']['LeaderGroupID'])
                                            <td>
                                                <form action="{{ route('exitCompany', $row['user_id']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="edit btn btn-primary btn-sm ">
                                                        Kick</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <form action="{{ route('deleteCompany', $data['group_id']['group_id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="edit btn btn-danger btn-sm "> Delete
                                                        Group</button>
                                                </form>
                                            </td>
                                        @endif
                                    @else
                                        @if ($row['user_id'] != $data['userID'])
                                            <td>
                                                <a href="javascript:void(0)" class="edit btn btn-secondary btn-sm ">
                                                    Keluar</a>
                                            </td>
                                        @else
                                            <form action="{{ route('exitCompany', $row['user_id']) }}" method="POST">
                                                @csrf
                                                <td>
                                                    <button type="submit" class="edit btn btn-primary btn-sm ">
                                                        Keluar</button>
                                                </td>
                                            </form>
                                        @endif
                                    @endif

                                </tr>
                                <?php
                                $no++;
                                ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>


    <div class="modal fade example-modal-lg" id="addKelompok" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Buat Kelompok/Perusahaan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('create_company') }}" class="form-inline">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary">Nama Kelompok</div>
                            </div>
                            <input type="text" class="form-control" name='groupname' id="inlineFormInputGroupUsername2"
                                placeholder="Masukkan Nama Kelompok/Perusahaan" />

                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <button type="submit" class="btn btn-primary btn-md"> Submit </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data_company') }}",
                columns: [{
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        data: 'groupname',
                        name: 'groupname'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });

        });
    </script>
@endsection
