<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function skillsFind(Request $request){
//        dd($request->term);
        $term = trim($request->skill);

        if (empty($term)) {
            return \Response::json([]);
        }

        $skills = Skill::where('name', 'like', '%'.$term.'%')->orWhere('slug', 'like', '%'.$term.'%')->limit(10)->get();

        $formatted_tags = [];

        foreach ($skills as $skill) {
            $formatted_skill[] = ['id' => $skill->id, 'text' => $skill->name];
        }

        return \Response::json($formatted_skill);
    }
}
