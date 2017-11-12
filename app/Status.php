<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public static function alias($status)
    {
        $alias = 'Deleted';
        switch ($status) {
            case '1' :
                $alias = 'Open';
                break;
            case '2' :
                $alias = 'Finish';
                break;
            case '3' :
                $alias = 'On Going';
                break;
            case '4' :
                $alias = 'Surveyed';
                break;
        }

        return $alias;
    }
}
