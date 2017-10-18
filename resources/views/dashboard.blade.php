@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Income</h5>
                    <h1 class="no-margins">886,200</h1>
                    <div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                    <small>Total income</small>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Sebaran Jumantik</h5>
                    <h2>42/20</h2>
                    <div class="text-center">
                        <div id="sparkline5"><canvas width="140" height="140" style="display: inline-block; width: 140px; height: 140px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Lokasi Sebaran Jumantik</h5>
                </div>
                <div class="ibox-content">
                    <div id="map" class="google-map">
                        <h4>Maps Here</h4>
                    </div>
                </div>
                <div class="ibox-footer">
                    Legend Here
                </div>
            </div>
        </div>
    </div>

@endsection
