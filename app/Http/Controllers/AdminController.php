<?php

namespace App\Http\Controllers;

use App\Library\Services\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;

class AdminController extends Controller
{
    protected $userService;

	public function __construct(UserService $userService ){
        $this->userService = $userService;
	}

    public function index(Request $request)
    {
       return view('dashboard');
	}

    public function users(Request $request)
    {
       $users = $this->userService->getusers();
       return view('user/users',['users' => $users]);
	}

    public function importUser(Request $request)
    {
       return view('user/importUser');
	}

    public function importFile(Request $request)
    {
      $value  = Excel::import(new ImportUser, $request->file('file')->store('files'));
      return redirect()->back();
    }

    
}
