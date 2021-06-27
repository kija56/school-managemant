<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = [];
		return view('user/create_user',$data);
	}
}
