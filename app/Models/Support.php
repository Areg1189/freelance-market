<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Support extends Model
{
//    use Translatable;
//    protected $translatable = ['name'];

    protected $fillable = ['parent_id','name', 'description','slug'];

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }

    public function pivotSupports()
    {
        return $this->belongsToMany(self::class ,'support_pivot', 'main_support_id','support_id');
    }

    public function parentSupports()
    {
        return Support::where('parent_id', null)->get();
    }

    public function supportLikes()
    {
        return $this->belongsToMany(self::class, 'supports_like_history','support_id','user_id');
    }
}
