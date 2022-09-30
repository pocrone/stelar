@extends('guru.layouts.master')

@section('title', 'Pimpinan - Surat Masuk')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="card w-100">
                <div class="card-header">Pimpinan - Surat Masuk</div>
                <div class="card-body">
                    <table class="table inbox_datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Editor</th>
                                <th>Nomor Surat</th>
                                <th>Sifat Surat</th>
                                <th>Detail Surat</th>
                                <th>Pengirim</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>

@endsection
@section('customjs')

    <script>
        $(document).ready(function() {
            var table = $('.inbox_datatable').DataTable({
                lengthChange: false,
                processing: true,
                serverSide: true,
                ajax: '{!! route('leader_inbox_data', ['group_id' => $group_id]) !!}', // memanggil route yang menampilkan data json
                "columns": [{
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "mail_number"
                    },
                    {
                        "data": "mail_attribute"
                    },
                    {
                        "data": "mail_summary"
                    },

                    {
                        "data": "sender"
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data == '0')
                                return "<label class='badge badge-warning'>Closed</label>";
                            else
                                return "<label class='badge badge-info'>Open</label>";
                        }
                    },

                    {
                        "data": 'action',
                        'orderable': false,
                        'searchable': false
                    },

                ],
                order: [
                    [1, 'asc']
                ],

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
