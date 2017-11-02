@extends('layouts.clean')

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Peta Sebaran</h5>

                </div>
                <div class="ibox-content" style="position: relative;">
                    {{--custom maps tools--}}
                    <div style="width: 20em; position: absolute; top:0; bottom: 0; z-index: 1000; margin: 60px 8px">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h5 class="panel-title">Wilayah</h5>
                            </div>
                            <div class="panel-body no-padding">

                                <form id="filter-wilayah">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"  class="js-switch" value="sekolah" checked/> Sekolah
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="js-switch" value="faskes" checked/> Fasilitas Kesehatan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="js-switch" value="perkimtan" checked/> Perkimtan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="js-switch" value="perumahan" checked/> Perumahan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="js-switch" value="apartment" checked/> Apartment
                                            </label>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    {{--/custom maps tools--}}
                    <div id="map" class="google-map" style=" height: 500px !important;">

                    </div>

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
