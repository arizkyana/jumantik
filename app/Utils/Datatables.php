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


    public function __construct()
    {

    }

    public static function is_sort_or_search($request)
    {
        return $request->input('columns') or $request->input('order') or $request->input('search');
    }

    public static function like($request, $data)
    {
        $column_input = $request->input('columns');
        $search_input = $request->input('search');

        // search
        if (!empty($search_input['value'])) {

            $keyword = $search_input['value'];

            // create search query with '%like%'
            $data->where($column_input[0]['name'], 'like', '%' . $keyword . '%');
            foreach ($column_input as $key => $val) {
                // field is able to search

                if ($val['searchable'] === "true") {
                    $data->orWhere($val['name'], 'like', '%' . $keyword . '%');
                }
            }

        }

        return $data;
    }

    public static function order($request, $data)
    {
        // order by

        $column_input = $request->input('columns');
        $order_input = $request->input('order');

        $column = $column_input[$order_input[0]['column']]['name'];


        $data->orderBy($column, $order_input[0]['dir']);

        return $data;

    }

}