@extends('siswa.layouts.master')

@section('title', 'Sekretaris | Klasifikasi Surat')

@section('navbar')
    @include('siswa.layouts.secretary-sidebar')
@stop

@section('content')
    <div class="container">
        <button data-toggle="modal" data-target="#addKlasifikasi" class="btn btn-info btn-md mb-2">Buat Klasifikasi
            Surat</button>
        <div class="row">
            <div class="col-12 table">
                <table class="table table-sm table-bordered klasifikasi_datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th> Klasifkasi</th>
                            <th>Sub Klasifkasi </th>
                            <th>Action</th>
                        </tr>

                    </thead>

                </table>

            </div>
        </div>

    </div>


    <div class="modal fade" id="addKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Klasifikasi Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add_classification') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Klasifkasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inp_klasifikasi"
                                    placeholder="Masukkan Klasifikasi" name='class'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Sub Klasifkasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inp_sub_klasifikasi"
                                    placeholder="Masukkan Sub Klasifikasi" name='sub_class'>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Klasifikasi Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id='edit_form'>
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Klasifkasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inp_klasifikasi"
                                    placeholder="Masukkan Klasifikasi" name='class'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Sub Klasifkasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inp_sub_klasifikasi"
                                    placeholder="Masukkan Sub Klasifikasi" name='sub_class'>
                            </div>

                            <input type="hidden" id='hidden_id' name="input_id" value="">
                        </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customjs')

    <script>
        $(document).ready(function() {
            $('#edit_button').click(function() {
                // console.log(getAttribute('data-ID'))
            })
        });
    </script>

    <script>
        function getclick_2(id) {
            var edit_url = "{{ route('edit_classification') }}" + '/' + id;
            // var edit_url = $('#edit_form').attr('action') + id;
            console.log(id);
            console.log(edit_url);
            $('#edit_form').attr('action', edit_url);
        }
    </script>

    <script>
        $(document).ready(function() {
            var table = $('.klasifikasi_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('secretary_classification') }}",
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
