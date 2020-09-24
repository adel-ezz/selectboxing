<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BoxList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id','type'];


    ////===========Relations==============////

    /**
     * this relation of boxList
     * will return user related user that have current model of boxlist item
     */
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
