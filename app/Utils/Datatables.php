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

    public function __construct(){}

    public static function like_or_order($request)
    {

        $query_str = "";

        // input
        $column_input = $request->input('columns');
        $order_input = $request->input('order');
        $search_input = $request->input('search');


        // search
        if (!empty($search_input['value'])) {

            $like = " WHERE ";
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

        // order by
        if (isset($order_input)) {
            $order_by = " ORDER BY ";
            $column = $order_input[0]['column'];
            $dir = $order_input[0]['dir']; // asc / desc

            $selected_column = $column_input[$column];

            if ($selected_column['orderable']) {
                $order_field = $selected_column['data'];
                $order_by .= $order_field . " " . $dir;
                $query_str .= $order_by;
            }

        }

        return $query_str;
    }

}