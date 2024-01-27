<?php

namespace App\Library\Services;

use App\Models\User;
use App\Models\User_image;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Config;

class UserService
{
	
	public function addUser(array $da)
    {
		$userDetail = new User();
		$userDetail->first_name=$da['first_name'];
		$userDetail->middle_name=$da['middle_name'];
		$userDetail->last_name=$da['last_name'];
		$userDetail->mobile=$da['mobile'];
		$userDetail->state=$da['state'];
		$userDetail->city=$da['city'];
		$userDetail->address=$da['address'];
		$userDetail->save();
		return $userDetail;
	}
	
	public function getusers()
    {
		$users = DB::table('users')
            ->join('user_image', 'users.id', '=', 'user_image.user_id')
            ->select('users.*', 'user_image.image_name')
            ->get();
		return $users;
	}

	public function addUserImage(array $da)
    {
		$userImage = new User_image();
		$userImage->user_id=$da['user_id'];
		$userImage->image_name=$da['image_name'];
		$userImage->save();
		return $userImage;
	}
	
	
}
