@extends('guru.layouts.master')

@section('title', 'Informasi Kelompok')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Informasi Kelompok</div>
                <div class="card-body">
                    @foreach ($user_group as $index => $row)
                        <p>{{ $index + 1 }}. {{ $row->name }}
                            @if ($row->user_id == $row->LeaderGroupID)
                                <span class="text-primary"> (Ketua)</span>
                            @endif
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rekap Hasil Tugas</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Tugas</th>
                            <th>Nilai</th>
                            <th>Komentar</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($assignment_results as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>
                                        @if ($row->value == null)
                                            <span class="text-danger">Belum dinilai</span>
                                        @else
                                            {{ $row->value }}
                                        @endif
                                    </td>
                                    <td>
                                        <span>

                                            @if ($row->value == null)
                                                <span class="text-danger">Belum dinilai</span>
                                            @else
                                                {{ $row->comment }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editValue-{{ $row->result_id }}">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editValue-{{ $row->result_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editValueLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editValueLabel">
                                                            Nilai tugas {{ $row->title }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('evaluate') }}">
                                                        <div class="modal-body">

                                                            @csrf
                                                            @error('value')
                                                                {{ $message }}
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="value">Nilai</label>
                                                                <input type="number" class="form-control" id="value"
                                                                    placeholder="Nilai" name="value"
                                                                    value={{ $row->value }}>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Komentar</label>
                                                                <textarea id="comment" placeholder="Komentar" name="comment" class="form-control" cols="30" rows="10">{{ $row->comment }}</textarea>
                                                            </div>
                                                            <input type="hidden" name="group_id"
                                                                value="{{ $group_id }}">
                                                            <input type="hidden" name="assignment_id"
                                                                value="{{ $row->result_id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <input type="submit" class="btn btn-primary" value="Simpan">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





@endsection
