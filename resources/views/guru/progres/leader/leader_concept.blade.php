@extends('guru.layouts.master')

@section('title', 'Pimpinan - Konsep Surat')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                Pimpinan - Konsep Surat
            </div>

            <div class="card-body">
                <table class="table user_datatable ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pimpinan</th>
                            <th>Konsep Surat</th>
                            <th>Status</th>
                        </tr>

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                lengthChange: false,
                processing: true,
                serverSide: true,
                ajax: '{!! route('leader_concept_data', ['group_id' => $group_id]) !!}',
                columns: [{
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mail_concept',
                        name: 'mail_concept'
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data == '0')
                                return "<label class='badge badge-warning'>Wait</label>";
                            else
                                return "<label class='badge badge-success'>Created</label>";
                        }
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
