<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ResultModel;
class Student extends BaseController
{
	public function __construct()
	{

		if (!isset($_SESSION['id'])) {
			return redirect('login');
		}
	}
	public function index()
	{
		//
	}

	public function courseresults()
	{
		$results = new ResultModel();
		$user=session()->get('id');
		$data['results'] = $results
			->where('results.user_id', $user)
			->join('classes', 'classes.id = results.class_id')
			->join('users', 'users.id = results.user_id')
			->join('subjects', 'subjects.id = results.subject_id')
			->findAll();
		echo view('studentResults',  $data);
	}
}
