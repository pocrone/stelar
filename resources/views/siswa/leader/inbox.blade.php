@extends('siswa.layouts.master')

@section('title', 'Pimpinan | Surat Masuk')

@section('navbar')
    @include('siswa.layouts.leader-sidebar')
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="card p-4">
                <h4 class="card-title card-header d-flex justify-content-between align-items-center">
                    Data Surat Masuk </h4>
                <div class="col-12 table table-responsive">
                    <table class="table table-bordered inbox_datatable table-striped" style="width: 100%;">
                        <thead class="bg-primary text-white">
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
                ajax: "{{ route('inbox') }}",
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
