<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function changeCountry(Request $request, Country $country){
        $data = '';
        foreach ($country->cities->sortBy('name') as $city){
            $data .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        return $data;
    }
}
