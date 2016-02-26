<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:47 PM
 */

namespace App\Http\Controllers\AppApi;


use Dingo\Api\Http\Request;

class SearchController extends PublicApiController
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        //Delegate this task to a search Service
        //Get the result , Transform , and send it back
    }
}