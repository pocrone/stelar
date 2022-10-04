@extends('guru.layouts.master')

@section('title', 'Arsiparis - Surat Masuk')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')

    <div class="container">

        <div class="card w-100">
            <div class="card-header">Arsiparis - Surat Masuk</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 table">
                        <table class="table table-bordered inbox_datatable" style="width: 100%;">
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

                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            var table = $('.inbox_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('inbox_archive_progress', $group_id) }}",
                    "dataType": "json",

                },
                "columns": [{
                        "data": "id",
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
