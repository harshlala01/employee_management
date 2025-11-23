<?php 
namespace App\Controllers;

use App\Models\EmployeeModel;

class Employee extends BaseController
{
    
    public function allEmployee()
    {
       
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        $employeeModel = new EmployeeModel();
        $data['employees'] = $employeeModel->findAll(); 

        return view('employee/allEmployee', $data);
    }

   
    public function add()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        return view('employee/add');
    }

    
    public function store()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        $employeeModel = new EmployeeModel();

        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $designation = $this->request->getPost('designation');
        $salary = $this->request->getPost('salary');

        // simple validation
        if (empty($name) || empty($address) || empty($designation) || empty($salary)) {
            return redirect()->back()->with('error', 'Please fill all fields!');
        }

        $picture = $this->request->getFile('picture');
        $pictureName = null;
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/', $pictureName);
        }

        $employeeData = [
            'name' => $name,
            'address' => $address,
            'designation' => $designation,
            'salary' => $salary,
            'picture' => $pictureName
        ];

        $employeeModel->save($employeeData);

        return redirect()->to('/employee')->with('success', 'Employee added successfully!');
    }


    public function edit($id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        $employeeModel = new EmployeeModel();
        $data['employee'] = $employeeModel->find($id);

        if (!$data['employee']) {
            return redirect()->to('/employee')->with('error', 'Employee not found!');
        }

        return view('employee/edit', $data);
    }

  
    public function update($id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        $employeeModel = new EmployeeModel();

        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $designation = $this->request->getPost('designation');
        $salary = $this->request->getPost('salary');

        if (empty($name) || empty($address) || empty($designation) || empty($salary)) {
            return redirect()->back()->with('error', 'Please fill all fields!');
        }

        $employeeData = [
            'name' => $name,
            'address' => $address,
            'designation' => $designation,
            'salary' => $salary
        ];

        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/', $pictureName);
            $employeeData['picture'] = $pictureName;
        }

        $employeeModel->update($id, $employeeData);

        return redirect()->to('/employee')->with('success', 'Employee updated successfully!');
    }

    
    public function delete($id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/users/login');
        }

        $employeeModel = new EmployeeModel();
        $employeeModel->delete($id);

        return redirect()->to('/employee')->with('error', 'Employee deleted successfully!');
    }
}
