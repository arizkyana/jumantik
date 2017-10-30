<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    protected $table = 'detail_laporan';

    public function status(){
        return $this->hasOne('App\Status');
    }
}
