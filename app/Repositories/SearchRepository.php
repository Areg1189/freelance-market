<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 12.02.2019
 * Time: 12:29
 */

namespace App\Repositories;


use App\Models\SaveSearch;
use App\Models\Skill;

class SearchRepository
{

    public function save($request, $freelancer){

        $save = SaveSearch::create([
            'keywords'=>$request->keywords,
            'category_id'=>$request->category,
            'freelancer_id'=>$freelancer->id,
            'location_id'=>$request->location,
            'project_type'=>$request->project_type,
            'skill_id'=> json_encode($request->skills),
            'budget'=>$request->budget,
        ]);

        if($request->keywords){
            $key = $request->keywords;
        }elseif($request->category){
            $key = $save->category->name;
        }else{
            $key = '';
            foreach (json_decode($save->skill_id) as $sk){
                $name  = Skill::where('id',$sk)->first()->name;

                $key .= ', '.$name;
            }
            $key = substr($key, 1);
        }
        return response()->json(['message'=> "You saving '$key' words."]);
    }
}