<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Contract
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{

	//Trait
	use \Illuminate\Auth\Authenticatable;

	public function posts(){
		return $this->hasMany('App\Post');
	}
	
}
