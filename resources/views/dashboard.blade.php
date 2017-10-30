@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Peta Sebaran</h5>

                </div>
                <div class="ibox-content">
                    <div id="map" class="google-map" style="height: 500px !important;">

                    </div>

                </div>
                <div class="ibox-footer">
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/> Sebaran Jumantik
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/> Sebaran Penyakit
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/> Lokasi RT
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/> Lokasi Puskesmas
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Jadwal Monitoring</h5>
                </div>
                <div class="ibox-content no-padding">
                    <table class="table table-hover table-responsive table-condensed no-margins">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Jadwal</th>
                            <th>Lokasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3">Belum ada Jadwal</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer">
                    <div class="text-right">
                        <a href="" class="btn btn-sm btn-link">Lihat Jadwal <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Statistik Jumantik</h5>
                    <div class="ibox-tools">
                        <form class="form-inline">
                            <div class="form-group">


                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">--Pilih Bulan--</option>
                                </select>


                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox-content">

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Statistik Jumantik</h5>
                    <div class="ibox-tools">
                        <form class="form-inline">
                            <div class="form-group">


                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">--Pilih Bulan--</option>
                                </select>


                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox-content">

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Statistik Jumantik</h5>
                    <div class="ibox-tools">
                        <form class="form-inline">
                            <div class="form-group">


                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">--Pilih Bulan--</option>
                                </select>


                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox-content">

                </div>
            </div>
        </div>

    </div>


@endsection
