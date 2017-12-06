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
                    <div class="filter-wilayah-container">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h5 class="panel-title">Wilayah</h5>
                            </div>
                            <div class="panel-body no-padding">

                                <form id="filter-wilayah" class="padding-md">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="sekolah" type="checkbox" class="js-switch" value="1"
                                            /> Sekolah
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" class="js-switch" value="2"
                                            /> Fasilitas Kesehatan
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" class="js-switch" value="3"
                                            /> Perkimtan
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" class="js-switch" value="4"
                                            /> Apartment
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" class="js-switch" value="5"
                                            /> Perumahan
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
                    <h5>Statistik Jumantik</h5>
                    <div class="ibox-tools">
                        <form class="form-inline" id="form-filter">
                            <div class="form-group">


                                <div class="input-group">
                                   <span class="input-group-addon">
                                       <i class="fa fa-calendar"></i>

                                   </span>
                                    <input name="bulan" id="bulan" class="form-control" placeholder="Pilih Bulan" value="{{ date('Y-m') }}"/>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="ct-jumantik" class="ct-perfect-fourth"></div>
                        </div>
                        <div class="col-md-4">
                            <div id="ct-penyakit-menular-nyamuk" class="ct-perfect-fourth"></div>
                        </div>
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
                            <th>PIC</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (empty($jadwal))
                            <tr>
                                <td colspan="3">Belum ada Jadwal</td>
                            </tr>
                        @else
                            @foreach ($jadwal as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ date('d M Y', strtotime($item->mulai)) }}
                                        s/d {{ date('d M Y', strtotime($item->akhir)) }}</td>
                                    <td>{{ $item->alamat }} , {{ $item->nama_kelurahan }}
                                        , {{ $item->nama_kecamatan }}</td>
                                    <td>{{ $item->pic }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer">
                    <div class="text-right">
                        <a href="{{ route('jadwal') }}" class="btn btn-sm btn-link">Lihat Jadwal <i
                                    class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
