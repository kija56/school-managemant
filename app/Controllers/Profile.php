<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
class Profile extends BaseController
{
	public function __construct()
	{

		if (!isset($_SESSION['id'])) {
			return redirect('login');
		}
	}
	public function index()
	{
		$user = session()->get('id');
		$userModel = new UserModel();
		$data['user'] = $userModel->where('id', $user)->find();
		echo view('user/profile', $data);	
	}
	
}
