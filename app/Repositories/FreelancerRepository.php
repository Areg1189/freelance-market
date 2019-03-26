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
use App\Traits\UploadeAvatar;
use App\Models\Skill;
use App\Traits\VerifyPayPal;

class FreelancerRepository
{

    Public function ajaxLoad($jobs, $page){
        $data['html'] = view('freelancers.partials.'.$page, compact('jobs'))->render();
        $data['nextUrl'] = $jobs->nextPageUrl() ?? false;
        $data['success'] = true;
        return $data;
    }


}