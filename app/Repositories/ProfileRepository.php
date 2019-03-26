<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 11.02.2019
 * Time: 13:54
 */

namespace App\Repositories;


use App\Models\Employer;
use App\Models\Freelancer;
use App\Models\FreelancerPortfolio;
use App\Models\FreelanceTitle;
use App\Models\Portfolio;

use App\Models\Skill;
use App\Traits\VerifyPayPal;

class ProfileRepository
{
    use VerifyPayPal;

    public function editProfile($user){
        $freelancer_titles = FreelanceTitle::get();
        $portfolios = Portfolio::get();
        $dataTypeContent = $user->freelancer;
        $skills = $user->freelancer->skills;
        return view('profile.edit',compact('user', 'dataTypeContent', 'freelancer_titles','skills', 'portfolios'));
    }

    public  function storeFreelancer($request, $user){

        $employments = $request->employments;
        $educations = $request->educations;
        $languages = $request->langs;

        $freelancer = Freelancer::where('user_id', $user->id)->first();
        $freelancer->country = $request->country_id;
        $freelancer->city = $request->city_id;
        $freelancer->birthday = $request->birthday;
        $freelancer->freelancer_id = $request->category_id;
        $freelancer->employments = $employments;
        $freelancer->educations = $educations;
        $freelancer->languages = $languages;
        $freelancer->availability = $request->availability;
        $freelancer->overview = $request->overview;

        $freelancer->hourly_rate = $request->hourly_rate;
        $freelancer->title = $request->title;
        $freelancer->save();
        $this->add_freelancer_skills($request->skills, $freelancer->id);

        return toastr()->success('Your information updated');
    }

    public function storeEmployer($request, $user){

        $country_id = $request->country_id;
        $city_id = $request->city_id;
        $birthday = $request->birthday;
        $pay_email = $request->pay_email;
//        $match_criteria = $request->match_criteria;
        $match_criteria = 'NONE';
        $state_id = getCities($city_id)->state_id;
        $country_code = getCountries($country_id)->code;
        $validator = new \Sirprize\PostalCodeValidator\Validator();

        $vv = $validator->isValid($country_code, $request->postal_code);
         if(!$vv){
             toastr()->warning("Zip Code is not validate!");
             return redirect()->back();
         }
        $employer = Employer::where('user_id', $user->id)->first();
        $employer->address = $request->address;
        $employer->country_id = $country_id;
        $employer->city_id = $city_id;
        $employer->state_id = $state_id;
        $employer->postal_code = $request->postal_code;
        $employer->birthday = $birthday;


        if ($this->verify_Paypal_Address($pay_email, $match_criteria) == "SUCCESS") {
            $employer->payer_email = $pay_email;
            $employer->save();
            toastr()->success('Your information updated');
            return redirect()->route('profile');
        }else{

            $employer->payer_email = null;
            $employer->save();

            toastr()->warning("Your PayPal address don't success!");
            return redirect()->back();
        }

    }

    public function storePortfolio($request, $user){
        $name = $this->uploadFile($request->port_file, 'portfolio-picture');
        $portfolio = Portfolio::create([
            'name' => $request->port_name,
            'link' => $request->port_link,
            'description' => $request->port_description,
            'image' => $name,
        ]);
        FreelancerPortfolio::create([
            'freelancer_id' => $user->freelancer->id,
            'portfolio_id' => $portfolio->id,
        ]);

        return $portfolio;
    }

    public function updatePortfolio($request, $id){
        $portfolio = Portfolio::find($id);
        if($request->hasFile('edit_file')) {
            $name = $this->uploadFile($request->edit_file, 'portfolio-picture');
            $portfolio->image = $name;
        }
        $portfolio->name = $request->edit_name;
        $portfolio->link = $request->edit_link;
        $portfolio->description = $request->edit_description;
        $portfolio->save();

        return $portfolio;
    }

    public function hidePortfolio($id){
        $portfolio = Portfolio::find($id);
        if($portfolio->show == 1){
            $portfolio->show = 0;
        }else{
            $portfolio->show = 1;
        }
        $portfolio->save();

        return $portfolio;
    }

    public function add_freelancer_skills(array $skills, $id)
    {
        $freelancer = Freelancer::find($id);

        if (isset($freelancer->skills) && $freelancer->skills->count() > 0) {
            $freelancer->skills()->detach();
        }
        foreach ($skills as $skill) {
            $freelancer->skills()->attach(Skill::where('id', $skill)->first());
        }
    }

    Public function ajaxLoad($jobs, $page){
        $data['html'] = view('profile.partials.'.$page, compact('jobs'))->render();
        $data['nextUrl'] = $jobs->nextPageUrl() ?? false;
        $data['success'] = true;
        return $data;
    }


}