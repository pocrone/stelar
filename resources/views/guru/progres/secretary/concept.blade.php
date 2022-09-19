@extends('guru.layouts.master')

@section('title', 'Sekretaris - Konsep Surat')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card w-100">
                    <div class="card-header">
                        Sekretaris - Konsep Surat
                    </div>
                    <div class="card-body">
                        <table class="table  user_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Konsep Surat</th>
                                    <th>Status</th>

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
            var table = $('.user_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": '{{ route('data_concept_progress', $group_id) }}',
                    "dataType": "json",

                },
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
                        "data": "mail_concept"
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data == '0')
                                return 'Wait';
                            else
                                return 'Created';
                        }
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

    <script>
        var edit_url = "{{ url('edit_concept') }}";

        function getclick(id) {
            console.log(edit_url);

            $('#edit_form').attr('action', edit_url + '/' + id);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#mail_concept').summernote({
                'height': '200',
                toolbar: false,
                placeholder: 'Tuliskan Perintah Konsep Surat'
            });
        });
        $(document).ready(function() {
            $('#edit_concept').summernote({
                'height': '200',
                toolbar: false,
                placeholder: 'Tuliskan Perintah Konsep Surat'
            });
        });
    </script>


@endsection
