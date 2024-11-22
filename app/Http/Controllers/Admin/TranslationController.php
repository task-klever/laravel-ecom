<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function front_edit()
    {
        $language_data = json_decode(file_get_contents(resource_path('lang/front.json')));
        return view('admin.translation.front', compact('language_data'));
    }

    public function front_update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        // Form Data
        $arr_key = [];
        foreach($request->key_arr as $item) {
            $arr_key[] = $item;
        }
        $arr_value = [];
        foreach($request->value_arr as $item) {
            $arr_value[] = $item;
        }

        // Updating Data
        for($i=0;$i<count($arr_key);$i++) {
            $data[$arr_key[$i]] = $arr_value[$i];
        }

        // New Data inserting into the existing json
        $new_json = json_encode($data,JSON_PRETTY_PRINT);
        file_put_contents(resource_path('lang/front.json'), $new_json);

        return redirect()->back()->with('success', 'Data is updated successfully!');
    }
}
