<?php
/**
 * Created by PhpStorm.
 * User: agung
 * Date: 10/28/2017
 * Time: 07:28
 */

namespace App\Utils;

use Illuminate\Http\Request;

class Datatables
{


    public function __construct(){

    }

    public static function is_sort_or_search($request){
        return $request->input('columns') or $request->input('order') or $request->input('search');
    }

    public static function like_or_order($request)
    {

        $query_str = "";

        // input
        $column_input = $request->input('columns');
        $order_input = $request->input('order');
        $search_input = $request->input('search');


        // search
        if (!empty($search_input['value'])) {

            $like = " ";
            $keyword = $search_input['value'];

            // create search query with '%like%'
            foreach ($column_input as $key => $val) {
                // field is able to search


                if ($val['searchable']) {
                    $like .= "upper(" . $val['data'] . ")" . " LIKE '%" . strtoupper($keyword) . "%' OR ";
                }
            }
            $like = rtrim($like, " OR ");
            $query_str .= $like;
        }



        return $query_str;
    }

}