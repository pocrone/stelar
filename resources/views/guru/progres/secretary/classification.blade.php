@extends('guru.layouts.master')

@section('title', 'Sekretaris - Klasifikasi Surat')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="card w-100">
                <div class="card-header">Sekretaris - Klasifikasi Surat</div>
                <div class="card-body">
                    <table class="table klasifikasi_datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> Klasifkasi</th>
                                <th>Sub Klasifkasi </th>
                            </tr>

                        </thead>

                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('customjs')


    <script>
        $(document).ready(function() {
            var table = $('.klasifikasi_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('secretary_classification_progress', ['group_id' => $group_id]) }}",
                    "dataType": "json",

                },
                "columns": [{
                        "data": 'id',
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        "data": "class"
                    },
                    {
                        "data": "sub_class"
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
