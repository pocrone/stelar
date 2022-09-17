@extends('guru.layouts.master')

@section('title', 'Informasi Kelompok')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>

        </ol>
    </nav>
    <div class="row">
        <div class="card">
            <div class="card-header">DATA KELOMPOK</div>
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
        <div class="card">
            <div class="card-header">DATA Tugas</div>
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
                                        belum dinilai
                                    @else
                                        {{ $row->value }}
                                    @endif
                                </td>
                                <td>
                                    @if ($row->value == null)
                                        belum dinilai
                                    @else
                                        {{ $row->comment }}
                                    @endif
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
                                                                placeholder="Judul materi" name="value"
                                                                value={{ $row->value }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="comment">Komentar</label>
                                                            <input type="text" class="form-control" id="comment"
                                                                placeholder="Judul materi" name="comment"
                                                                value="{{ $row->comment }}">
                                                        </div>
                                                        <input type="hidden" name="group_id" value="{{ $group_id }}">
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





@endsection
