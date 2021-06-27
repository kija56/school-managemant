<?php

namespace App\Controllers;


use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{
	public function dashboard()
	{
		$this->load->model('queries');
		$college_id = $this->session->userdata('college_id');
		$students = $this->queries->getStudents($college_id);
		$this->load->view('users', ['students' => $students]);
	}
}
