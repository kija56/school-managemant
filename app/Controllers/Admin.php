<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ResultModel;

class Admin extends Controller
{

	public function __construct()
	{

		if (!isset($_SESSION['id'])) {
			return redirect('login');
		}
	}

	public function dashboard()
	{
		$this->load->model('queries');
		$collegeUsers = $this->queries->viewAllColleges();
		$this->load->view('dashboard', ['collegeUsers' => $collegeUsers]);
	}

	public function addCollege()
	{
		helper(['form']);
		echo view('addCollege');
	}

	public function createCourse()
	{
		helper(['form']);
		//set rules validation form
		$rules = [
			'class_name'          => 'required|min_length[3]|max_length[200]',

		];

		if ($this->validate($rules)) {
			$model = new ClassModel();
			$data = [
				'class_name'     => $this->request->getVar('class_name'),
			];
			$model->save($data);
			return redirect()->to('/admin/viewcourses');
		} else {
			$data['validation'] = $this->validator;
			echo view('addCollege', $data);
		}
	}

	public function createSubject()
	{
		helper(['form']);
		//set rules validation form
		$rules = [
			'subject_name'          => 'required|min_length[3]|max_length[200]',
			'points'          => 'required',

		];

		if ($this->validate($rules)) {
			$model = new SubjectModel();
			$data = [
				'subject_name'     => $this->request->getVar('subject_name'),
				'points'     => $this->request->getVar('points'),
				'class_id'     => $this->request->getVar('class_id'),
				'instructor'     => $this->request->getVar('instructor'),
			];
			$model->save($data);
			return redirect()->to('/admin/viewsubjects');
		} else {
			$data['validation'] = $this->validator;
			echo view('addSubject', $data);
		}
	}

	public function addStudent()
	{
		helper(['form']);
		$classModel = new ClassModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		echo view('addStudent', $data);
	}

	public function addResults()
	{
		helper(['form']);
		$classModel = new ClassModel();
		$subjectModel= new SubjectModel();
		$userModel = new UserModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		$data['subjects'] = $subjectModel->orderBy('id', 'ASC')->findAll();
		$data['students'] = $userModel
		->where('role_name', 'STUDENT')
		->orderBy('id', 'ASC')->findAll();
		echo view('addResults', $data);
	}

	public function createStudent()
	{
		//include helper form
		helper(['form']);
		//set rules validation form
		$rules = [
			'first_name'          => 'required|min_length[3]|max_length[20]',
			'last_name'          => 'required|min_length[3]|max_length[20]',
			'role_name'          => 'required|min_length[3]|max_length[20]|is_unique[users.phone_number]',
			'phone_number'          => 'required|min_length[10]|max_length[12]',
			'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
			'password'      => 'required|min_length[6]|max_length[200]',
			'confpassword'  => 'matches[password]'
		];

		if ($this->validate($rules)) {
			$model = new UserModel();
			$data = [
				'first_name'     => $this->request->getVar('first_name'),
				'last_name'     => $this->request->getVar('last_name'),
				'gender' => $this->request->getVar('gender'),
				'phone_number' => $this->request->getVar('phone_number'),
				'gender' => $this->request->getVar('gender'),
				'role_name' => $this->request->getVar('role_name'),
				'class_id' => $this->request->getVar('class_id'),
				'email'    => $this->request->getVar('email'),
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
			];
			$model->save($data);
			return redirect()->to('/admin/viewstudents');
		} else {
			$data['validation'] = $this->validator;
			echo view('addStudent', $data);
		}
	}

	public function viewstudents()
	{
		$userModel = new UserModel();

		$data['students'] = $userModel
			->orderBy('users.id', 'ASC')
			->where('role_name', 'STUDENT')
			->join('classes', 'classes.id = users.class_id')
			->findAll();
		echo view('viewStudents',  $data);
	}

	public function viewsubjects()
	{
		
		$subjectModel = new SubjectModel();

		$data['subjects'] = $subjectModel
			->orderBy('subjects.id', 'ASC')
			->join('classes', 'classes.id = subjects.class_id')
			->join('users', 'users.id = subjects.instructor')
			->findAll();
		echo view('viewSubjects',  $data);
	}
	public function courseresults()
	{
		$results = new ResultModel();

		$data['results'] = $results
			->orderBy('results.id', 'ASC')
			->join('classes', 'classes.id = results.class_id')
			->join('users', 'users.id = results.user_id')
			->join('subjects', 'subjects.id = results.subject_id')
			->findAll();
		echo view('viewResults',  $data);
	}


	public function viewcourses()
	{
		$classModel = new ClassModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		echo view('viewCourses',  $data);
	}

	public function editUser($id)
	{
		helper(['form']);
		$userModel = new UserModel();

		$data['student'] = $userModel
			->where('users.id', $id)
			->join('classes', 'classes.id = users.class_id')
			->get();
		echo view('editStudent', $data);
	}

	public function addModerator()
	{
		helper(['form']);
		$classModel = new ClassModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		echo view('addModerator', $data);
	}
	public function addSubject()
	{
		helper(['form']);
		$classModel = new ClassModel();
		$userModel = new UserModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		$data['instructors'] = $userModel->orderBy('id', 'ASC')->where('role_name', 'INSTRUCTOR')->findAll();
		echo view('addSubject', $data);
	}

	public function createModerator()
	{
		//include helper form
		helper(['form']);
		//set rules validation form
		$rules = [
			'first_name'          => 'required|min_length[3]|max_length[20]',
			'last_name'          => 'required|min_length[3]|max_length[20]',
			'role_name'          => 'required|min_length[3]|max_length[20]|is_unique[users.phone_number]',
			'phone_number'          => 'required|min_length[10]|max_length[12]',
			'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
			'password'      => 'required|min_length[6]|max_length[200]',
			'confpassword'  => 'matches[password]'
		];

		if ($this->validate($rules)) {
			$model = new UserModel();
			$data = [
				'first_name'     => $this->request->getVar('first_name'),
				'last_name'     => $this->request->getVar('last_name'),
				'gender' => $this->request->getVar('gender'),
				'phone_number' => $this->request->getVar('phone_number'),
				'role_name' => $this->request->getVar('role_name'),
				'email'    => $this->request->getVar('email'),
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
			];
			$model->save($data);
			return redirect()->to('/admin/moderator');
		} else {
			$data['validation'] = $this->validator;
			echo view('addModerator', $data);
		}
	}

	public function saveResults()
	{
		//include helper form
		helper(['form']);
		//set rules validation form
		$rules = [
			'class_id'          => 'required',
			'subject_id'          => 'required',
			'user_id'          => 'required',
			'score'          => 'required',
			
		];

		if ($this->validate($rules)) {
			$model = new ResultModel();
			$data = [
				'class_id'     => $this->request->getVar('class_id'),
				'subject_id'     => $this->request->getVar('subject_id'),
				'user_id' => $this->request->getVar('user_id'),
				'score' => $this->request->getVar('score'),
				'status' => 'Published',
				
			];
			$model->save($data);
			return redirect()->to('/admin/courseresults');
		} else {
			$data['validation'] = $this->validator;
			echo view('addModerator', $data);
		}
	}

	public function modifystudent($id)
	{
		$this->form_validation->set_rules('studentname', 'Student Name', 'required');
		$this->form_validation->set_rules('college_id', 'College Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();

			$this->load->model('queries');
			if ($this->queries->updateStudent($data, $id)) {
				$this->session->set_flashdata('message', 'Student Updated Successfully');
			} else {
				$this->session->set_flashdata('message', 'Failed To Update!');
			}

			return redirect('admin/addStudent');
		} else {
			$this->editStudent();
		}
	}

	public function deletestudent($id)
	{
		$this->load->model('queries');
		if ($this->queries->removeStudent($id)) {
			return redirect('admin/dashboard');
		} else {
			return redirect('admin/dashboard');
		}
	}
	public function deleteCourse($id)
	{
		$classModel = new ClassModel();
		$data['courses'] = $classModel->orderBy('id', 'ASC')->findAll();
		$class = $classModel->where('id', $id);
		if ($class->delete()) {
			echo  view('viewCourses', $data);
		} else {
			return redirect('admin/dashboard');
		}
	}
	public function deleteUser($id)
	{
		$userModel = new UserModel();
		$data['collegUsers'] = $userModel->orderBy('id', 'ASC')->findAll();
		$class = $userModel->where('id', $id);
		if ($class->delete()) {
			echo  view('dashboard', $data);
		} else {
			return redirect('admin/dashboard');
		}
	}

	public function moderator()
	{
		$userModel = new UserModel();

		$data['instructors'] = $userModel
			->orderBy('users.id', 'ASC')
			->where('role_name', 'INSTRUCTOR')
			->findAll();
		echo view('viewModerator',  $data);
	}
}
