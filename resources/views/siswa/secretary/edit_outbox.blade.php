@extends('siswa.layouts.master')

@section('title', 'Sekretaris | Edit Surat')

@section('navbar')
    @include('siswa.layouts.secretary-sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Informasi Konsep Surat</label>
                    <hr>
                    <p>Pimpinan : {{ $concept->name }}</p>
                    <p>Isi Konsep:</p>
                    <p>{{ $concept->mail_concept }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form enctype="multipart/form-data" action="{{ route('update_outbox', $mail->id) }}" method="POST">
                            @csrf
                            <div class="text-dark mb-4 h4 bg-gradient-success ml--4 text-white p-2 col-md-3">Kop Surat</div>
                            <input type="hidden" name="id_konsep" value="{{ $concept->conceptID }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Jenis
                                            Instansi</label>
                                        <div>
                                            <input type="text" name="main_institution" class="form-control"
                                                value="{{ $mail->main_institution }}"
                                                placeholder="contoh : DINAS PENDIDIKAN DAN KEBUDAYAAN">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Nama Instansi</label>
                                        <div>
                                            <input type="text" name="name_institution" class="form-control"
                                                value="{{ $mail->name_institution }}" placeholder="SMK SEBELAS MARET">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label">Alamat Instansi</label>
                                        <div class="">
                                            <textarea type="text" name="address_institution" class="form-control" value=""
                                                placeholder="Jalan Soekarno-Hatta No.18 Kota Malang">{{ $mail->address_institution }} </textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Telp /
                                            HP</label>
                                        <div>
                                            <input type="text" name="phone_institution" class="form-control"
                                                value="{{ $mail->phone_institution }}"
                                                placeholder="contoh: (031) 47189xxx ">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label">Logo Instansi</label>
                                        <div>
                                            <input type="file" name="logo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Email</label>
                                        <div>
                                            <input type="email" name="email_institution" class="form-control"
                                                value="{{ $mail->email_institution }}"
                                                placeholder="contoh : emaildinas@email.com">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-dark mb-4 h4 bg-gradient-success ml--4 text-white p-2 col-md-3">Header Surat
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- wajib  -->
                                        <label for="" class="control-label">Tanggal</label>
                                        <div class="input-group date">
                                            <input type="text" id="mail_date" name="mail_date" class="form-control"
                                                value=" {{ date('Y-m-d', strtotime($mail->mail_date)) }}" required>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Nomor
                                            Surat</label>
                                        <div>
                                            <input type="text" name="outboxmail_number" class="form-control"
                                                value="{{ $mail->outboxmail_number }}"
                                                placeholder="contoh: 187/AM/IX/2015">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Perihal</label>
                                        <div>
                                            <input type="text" name="mail_about" class="form-control"
                                                value="{{ $mail->mail_about }}" placeholder="contoh: Pemberitahuan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Lampiran</label>
                                        <div>
                                            <input type="text" name="attachment" class="form-control"
                                                value="{{ $mail->attachment }}" placeholder="-">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="text-dark mb-4 h4 bg-gradient-success ml--4 text-white p-2 col-md-3">Alamat Tujuan
                            </div>
                            <div class="form-group col-12 p-0">
                                <label for="" class="control-label">Penerima Surat</label>
                                <div>
                                    <div class="">
                                        <input type="text" placeholder="contoh: Yth. Bapak/Ibu Guru"
                                            name="mail_recevier" class="form-control"
                                            value="{{ $mail->mail_recevier }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Nama
                                            Instansi Tujuan</label>
                                        <div>
                                            <input type="text" name="mail_destination" class="form-control"
                                                value="{{ $mail->mail_destination }}"
                                                placeholder="contoh: SMK Sebelas Maret">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Kota Instansi Tujuan</label>
                                        <div>
                                            <input type="text" name=" city_destination" class="form-control"
                                                value="{{ $mail->city_destination }}" placeholder="contoh: Kebumen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-dark mb-4 h4 bg-gradient-success ml--4 text-white p-2 col-md-3">Isi Surat
                            </div>

                            <div class="col-md-12 p-0">
                                <div class="form-group">
                                    <label for="" class="control-label">Salam
                                        Pembuka</label>
                                    <div>
                                        <input type="text" name="preambule" class="form-control"
                                            value="{{ $mail->preambule }}" placeholder="contoh: Dengan Hormat">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0">
                                <div class="form-group">
                                    <label for="" class="control-label">Isi Surat</label>
                                    <div>
                                        <textarea name="mail_detail" id='outbox_mail' class="form-control outbox_mail">{!! $mail->mail_detail !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0">
                                <div class="form-group">
                                    <label for="" class="control-label">Salam
                                        Penutup</label>
                                    <div>
                                        <input type="text" name="closing_sentence" class="form-control"
                                            value="{{ $mail->closing_sentence }}" placeholder="contoh: Hormat Kami">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="control-label">Atas Nama</label>
                                        <div>
                                            <input type="text" name="mail_officer"
                                                placeholder="contoh: Indah Setyorini" value="{{ $mail->mail_officer }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="control-label">Jabatan</label>
                                        <div>
                                            <input type="text" name="officer" placeholder="contoh: Kepala Sekolah"
                                                value="{{ $mail->officer }}" class="form-control">
                                            <!-- <input type="hidden" name="tipe" value="Hanging" class="form-control"> -->
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="control-label">Nomor Identitas (Bila Perlu) </label>
                                        <div>
                                            <input type="text" name="identity_number"
                                                placeholder="contoh: NIP 160412607066 200 1" class="form-control"
                                                value="{{ $mail->identity_number }}">
                                            <!-- <input type="hidden" name="tipe" value="Hanging" class="form-control"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 p-0">
                                    <div class="form-group">
                                        <label for="" class="control-label">Tembusan</label>
                                        <div>
                                            <textarea name="notation" id='outbox_mail' class="form-control outbox_mail">{!! $mail->notation !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>

                    <input type="submit" value="Simpan Surat" class="btn btn-primary text-white form-control">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')

    <script>
        $(document).ready(function() {
            $('.outbox_mail').summernote({
                height: 150,

                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    // ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });
        });

        $('.outbox_mail').css('font-size', '12pt');
    </script>

    <script>
        $(document).ready(function() {
            $("#mail_date").datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endsection
