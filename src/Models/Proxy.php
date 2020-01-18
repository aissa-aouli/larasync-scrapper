<?php

namespace Larasync\Scrapper\Models;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $table = 'proxies';

    public $guarded = [];

    public function user_agent()
    {
        return $this->belongsToMany(UserAgent::class,'proxy_user_agent','proxy_id','user_agent_id')->first();
    }
}
