@extends('layouts.app')

@section('content')

    <form action="{{ action('Jumantik\LaporanController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Buat Laporan</h5>
            </div>
            <div class="ibox-content">
                {{ csrf_field() }}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group">
                    <div class="row">
                        <label for="penyakit" class="col-md-3">Penyakit
                            <small class="text-danger">*</small>
                        </label>
                        <div class="col-md-9">
                            <select name="penyakit" id="penyakit" class="form-control" data-placeholder="Pilih Penyakit" required>
                                <option value=""></option>
                                @foreach($penyakit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('penyakit'))
                                <i class="text-danger">{{ $errors->first('penyakit')  }}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3" for="keterangan">Keterangan</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30"
                                      rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="is_suspect_dbd" class="col-md-3">&nbsp;</label>
                        <div class="col-md-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_suspect_dbd" id="is_suspect_dbd"/> Suspect DBD
                                </label>
                            </div>

                            <div class="input-group" id="input_suspect_dbd" style="width: 30%">
                                <input type="number" class="form-control" name="jumlah_suspect_dbd" required/>
                                <span class="input-group-addon">
                                    Jiwa
                                </span>

                            </div>

                        </div>
                    </div>
                </div>

                <fieldset>
                    <legend>Lokasi</legend>
                    <div class="form-group">
                        <div class="row">
                            <label for="kecamatan" class="col-md-3">Kecamatan</label>
                            <div class="col-md-9">
                                <select name="kecamatan" id="kecamatan" class="form-control"
                                        data-placeholder="Pilih Kecamatan">
                                    <option value=""></option>

                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->kecamatan_id }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="kelurahan" class="col-md-3">Kelurahan</label>
                            <div class="col-md-9">
                                <select name="kelurahan" id="kelurahan" class="form-control"
                                        data-placeholder="Pilih Kelurahan">
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

            </div>
            <div class="ibox-footer ">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jumantik/laporan') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </form>



@endsection
