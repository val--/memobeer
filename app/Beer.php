<?php

namespace App;

use App\User;
use App\Beerslist;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name'];
    //protected $fillable = array('username', 'email', 'password');
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'user_id' => 'int',
    // ];
    public function beerslist()
    {
        return $this->belongsToMany('App\Beerslist');
    }

    public function style()
    {
        return $this->belongsTo('App\Style', 'style_id', 'id');
    }

    public function brewery()
    {
        return $this->belongsTo('App\Brewery', 'brewery_id', 'breweryId');
    }

}
