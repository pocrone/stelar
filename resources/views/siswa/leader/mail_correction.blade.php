@extends('siswa.layouts.master')

@section('title', 'Pimpinan | Koreksi Surat')

@section('navbar')
    @include('siswa.layouts.leader-sidebar')
@stop

@section('content')
    <div class="container">

        <div class="row ">
            <div class="card py-4 px-4 col-md-12">
                <h4 class="card-title card-header d-flex justify-content-between align-items-center">
                    Konsep Surat </h4>

                <div class="col-12 table">
                    <table class="table table-bordered user_datatable wrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Editor</th>
                                <th>Tanggal</th>
                                <th>Perihal Surat</th>
                                <th>Status Koreksi</th>
                                <th>Action</th>

                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addKonsep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buat Konsep Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create_mailconcept') }}" method="post">
                            {{ csrf_field() }}
                            <textarea id="mail_concept" name="mail_concept"></textarea>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editKonsep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Konsep Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id='edit_form' action="" method="post">
                            {{ csrf_field() }}
                            <textarea id="edit_concept" name="mail_concept"></textarea>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
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
                lengthChange: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('mail_correct') }}",
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
                        data: 'mail_date',
                        name: 'mail_date'
                    },
                    {
                        data: 'mail_about',
                        name: 'mail_about'
                    },
                    // {
                    //     "data": "status",
                    //     "render": function(data, type, row) {
                    //         if (data == '0')
                    //             return "<label class='badge badge-warning'>Belum Disetujui</label>";
                    //         else
                    //             return "<label class='badge badge-success'>Sudah Tersetujui</label>";
                    //     }
                    // },
                    {
                        "data": 'status_koreksi',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        "data": 'action',
                        'orderable': false,
                        'searchable': false
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

    <script>
        function getclick(id) {
            var edit_url = "{{ url('siswa/pimpinan/edit_konsep_surat') }}" + "/" + id;
            // var edit_url = $('#edit_form').attr('action') + id;
            console.log(id);
            console.log(edit_url);
            $('#edit_form').attr('action', edit_url);
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

    <script>
        $(document).ready(function() {
            $('#edit_button').click(function() {
                // console.log(getAttribute('data-ID'))
            })
        });
    </script>


@endsection
