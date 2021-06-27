<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
class Dashboard extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        //$collegeUsers = $userModel->orderBy('id', 'DESC')->findAll();
        $data['collegeUsers'] = $userModel->orderBy('id', 'ASC')->findAll();
		echo view('dashboard', $data);
    }
}
