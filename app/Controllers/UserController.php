<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    // show users list
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
        return view('user.user_view', $data);
    }
    public function login()
    {

        $validator = array('success' => false, 'messages' => array());

        $validate_data = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|callback_validate_username'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validate_data);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() === true) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $login = $this->model_users->login($username, $password);

            if ($login) {
                $this->load->library('session');

                $user_data = array(
                    'id' => $login,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                $validator['success'] = true;
                $validator['messages'] = "index.php/dashboard";
            } else {
                $validator['success'] = false;
                $validator['messages'] = "Incorrect username/password combination";
            } // /else

        } else {
            $validator['success'] = false;
            foreach ($_POST as $key => $value) {
                $validator['messages'][$key] = form_error($key);
            }
        } // /else

        echo json_encode($validator);
    } // /lgoin function
    // add user form
    public function create()
    {
        return view('user/create_user');
    }

    // insert data
    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));
    }

    // show single user
    public function singleUser($id = null)
    {
        $userModel = new UserModel();
        $data['user_obj'] = $userModel->where('id', $id)->first();
        return view('user/edit_user', $data);
    }

    // update user data
    public function update()
    {
        $userModel = new UserModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/users-list'));
    }

    // delete user
    public function delete($id = null)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/users-list'));
    }
}
