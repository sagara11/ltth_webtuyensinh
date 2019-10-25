<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Option;

class OptionController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function option(Request $request)
    {
        try{
            $option = Option::select('key_option','value')->get();

            foreach ($option as $row) {
                $options[$row->key_option] = $row->value;
            }

            $options = (object) $options;
            $response = [
                            'status' => true,
                            'data' => $options,
                        ];
                return response()->json($response);
            }catch(\Exception $e)
            {
                $response = [
                            'status' => false,
                        ];
                return response()->json($response);
            }
        
    }
}