<?php 
namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function registration()
    {
        helper('form');
        $data['title'] = "User Registration";

        if ($this->request->getMethod() === "POST") {
            $rules = [
                'name' => 'required|max_length[100]',
                'user_name' => 'required|max_length[50]|is_unique[login_details.user_name]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $userModel = new UserModel();
                $userModel->save([
                    'name' => $this->request->getPost('name'),
                    'user_name' => $this->request->getPost('user_name'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                ]);

                session()->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/users/login');
            }
        }

        
        
        echo view('users/registration', $data);

        
    }

    public function login()
    {
        helper('form');
        $data['title'] = "User Login";

        if ($this->request->getMethod() === "POST") {
            $userModel = new UserModel();
            $user = $userModel->where('user_name', $this->request->getPost('user_name'))->first();

            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['user_name']
                ]);
                return redirect()->to('/employee/add');
            } else {
                session()->setFlashdata('error', 'Invalid username or password');
            }
        }

      
        echo view('users/login',$data);
        
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/users/login');
    }
}
