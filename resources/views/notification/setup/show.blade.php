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
            <h5>Notifikasi

            </h5>
            <div class="ibox-tools">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i> Send
                </a>
            </div>
        </div>
        <div class="ibox-content no-overflow">
            <div class="pull-right">
                {{ $setup->created_at }}
            </div>
            <h2>{{ $setup->title }}</h2>
            <blockquote>
                <p>
                    {{ $setup->body }}
                </p>
                <footer>
                    Notification Type
                    @if ($setup->type == 1)
                        <label class="label label-info">Broadcast</label>
                    @else
                        <label class="label label-primary">Single</label>
                    @endif
                </footer>
            </blockquote>
        </div>
        <div class="ibox-footer no-overflow">
            <div class="pull-right">
                <a href="{{ route('notification/setup') }}" class="btn btn-default">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
