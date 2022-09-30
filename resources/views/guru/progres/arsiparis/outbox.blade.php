@extends('guru.layouts.master')

@section('title', 'Arsiparis | Surat Keluar')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')

    <div class="container">


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 table">
                        <table class="table table-bordered inbox_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Editor</th>
                                    <th>Nomor Surat</th>

                                    <th>Perihal Surat</th>


                                    <th>Action</th>

                                </tr>

                            </thead>

                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addInbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Surat Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add_inbox_secretary') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inp_klasifikasi"
                                    placeholder="Masukkan Nomor Surat" name='mail_number'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inp_sub_klasifikasi" placeholder="yyyy-mm-dd"
                                    name='date'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Sifat Surat</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="mail_attribute" required>
                                    <option value="">Pilih Sifat Surat ... </option>
                                    <option value="Segera">Segera</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Rahasia">Rahasia</option>
                                    <option value="Biasa">Biasa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Perihal Surat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inp_sub_klasifikasi"
                                    placeholder="Masukkan Perihal Surat" name='mail_about'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Pengirim </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inp_sub_klasifikasi"
                                    placeholder="Masukkan Pengirim" name='sender'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Isi Ringkas Surat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inp_sub_klasifikasi" placeholder="Masukkan isi ringkas surat" height='200'
                                    name='mail_summary'></textarea>
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

@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            var table = $('.inbox_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('sec_outbox_progress', $group_id) }}",
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
                        "data": "outboxmail_number"
                    },

                    {
                        "data": "mail_about"
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
