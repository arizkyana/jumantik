@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif

    <div class="ibox">
        <div class="ibox-title">
            <h5>Riwayat Notifikasi</h5>

        </div>
        <div class="ibox-content ">

            <table id="table-dinkes" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Created At</th>
                    <th>Title</th>
                    <th>Receiver</th>
                    <th>Role</th>

                    <th>Status</th>

                    {{--<th class="text-center">Action</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($histories as $index => $history)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $history->created_at }}</td>
                        <td>{{ $history->title }}</td>
                        <td>{{ $history->name }}</td>
                        <td>{{ $history->role }}</td>
                        <td>
                            @if ($history->status)
                                <label class="label label-primary">Sent</label>
                            @elseif ($history->status)
                                <label class="label label-success">Done</label>
                            @else
                                <label class="label label-danger">Failed</label>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
