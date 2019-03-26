<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerPortfolio extends Model
{
    protected $table = 'freelancer_portfolio';

    protected $fillable = [
         'freelancer_id', 'portfolio_id'
    ];

    public $timestamps = false;
    public function portfolio(){
        return $this->belongsTo(Portfolio::class,'portfolio_id', 'id');
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id');
    }
}
