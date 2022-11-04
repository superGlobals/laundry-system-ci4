<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\CustomersModel;

class CustomersController extends BaseController
{   

    /**
     * Activate the helper and create function in helper folder
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Show customer management page
     */
    public function index()
    {
        $customer = new CustomersModel();
        $data['customers'] = $customer->findAll();
        return view('admin/customer-management', $data);
    }

    /**
     * Show add customer page
     */
    public function addCustomer()
    {
        return view('admin/add_customer');
    }

    public function storeCustomer()
    {
        $validated = $this->validate([
            'firstname' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required' => 'First Name is required',
                    'alpha_space' => 'First Name cannot accept numbers and symbols',
                    'min_length' => 'First Name must have atleast 3 letters',
                ]
            ],

            'lastname' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required' => 'Last Name is required',
                    'alpha_space' => 'Last Name cannot accept numbers and symbols',
                    'min_length' => 'Last Name must have atleast 3 letters',
                ]
            ],

            'contact' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Contact number is required',
                    'alpha_numeric' => 'Contact number can contain numbers only'
                ]
            ],

            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender is required',
                ]
            ],

            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Address is required',
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Invalid email',
                    'is_unique' => 'Email already used',
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be 6 character long',
                    'max_length' => 'Password cannot be longer than 20 characters',
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/add_customer', ['validation' => $this->validator]);
        }

        // check if image has value
        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // assign variable to hold the value of image
        if(!empty($_FILES['profile']['name']))
        {
            $imageProfile = $imageName;
        }
        else
        {
            $imageProfile = "user_male.jpg";
        }
        $pass = $this->request->getPost('password', FILTER_SANITIZE_SPECIAL_CHARS);
        $hash = Hash::encrypt($pass);

        $data = [
            'firstname' => $this->request->getPost('firstname', FILTER_SANITIZE_SPECIAL_CHARS),
            'middlename' => $this->request->getPost('middlename', FILTER_SANITIZE_SPECIAL_CHARS),
            'lastname' => $this->request->getPost('lastname', FILTER_SANITIZE_SPECIAL_CHARS),
            'contact' => $this->request->getPost('contact', FILTER_SANITIZE_NUMBER_INT),
            'address' => $this->request->getPost('address', FILTER_SANITIZE_SPECIAL_CHARS),
            'gender' => $this->request->getPost('gender', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
            'password' => $hash,
            'profile' => $imageProfile,
            'customer_id' => 'CID-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)),
        ];

        // call the users model
        $customer = new CustomersModel();
        $save = $customer->insert($data);

        if(!$save)
        {
            return redirect()->to(base_url('admin/add_customer'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving customer')
            ->with('status', 'error');
        }
        else
        {
            return redirect()->to(base_url('admin/add_customer'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Customer added successfully')
            ->with('status', 'Success');
        }
    }

    /**
     * Delete customer in database
     */
    public function deleteCustomer($id = null)
    {
        $customer = new CustomersModel();
        $customerProfile = $customer->find($id);
        $profile = $customerProfile->profile;

        if($profile == "user_male.jpg")
        {
            $customer->delete($id);
        }
        else
        {
            unlink("uploads/".$profile);
            $customer->delete($id);
        }

        $data = [
            'status' => 'Success',
            'status_text' => 'Customer Deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

    /**
     * Show edit customer page
     */
    public function editCustomer($id = null)
    {
        $customer = new CustomersModel();
        $data['customer'] = $customer->find($id);

        return view('admin/edit_customer', $data);
    }

    /**
     * Update user info in database
     */
    public function updateCustomer($id = null)
    {
        $validated = $this->validate([
            'firstname' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required' => 'First Name is required',
                    'alpha_space' => 'First Name cannot accept numbers and symbols',
                    'min_length' => 'First Name must have atleast 3 letters',
                ]
            ],

            'lastname' => [
                'rules' => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required' => 'Last Name is required',
                    'alpha_space' => 'Last Name cannot accept numbers and symbols',
                    'min_length' => 'Last Name must have atleast 3 letters',
                ]
            ],

            'contact' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Contact number is required',
                    'alpha_numeric' => 'Contact number can contain numbers only'
                ]
            ],

            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Position is required',
                ]
            ],

            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Address is required',
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Invalid email',
                ]
            ],

        
        ]);
        $updateCustomer = new CustomersModel();
        $data['customer'] = $updateCustomer->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/edit_customer', $data);
        }

        $db = db_connect();

        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $userProfile = $updateCustomer->find($id);
        $profile = $userProfile->profile;

        // update user profile
        if(!empty($_FILES['profile']['name']))
        {
            if($profile != "user_male.jpg")
            {
                unlink("uploads/".$profile);
                $updateProfile = "UPDATE tbl_customers SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
            else{
                $updateProfile = "UPDATE tbl_customers SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
        }

        $pass = $this->request->getPost('password', FILTER_SANITIZE_SPECIAL_CHARS);
        $hash = Hash::encrypt($pass);

        // update user password
        if(!empty($pass))
        {   
            $updatePass = "UPDATE tbl_customers SET password = :passoword: WHERE id = :id: LIMIT 1";
            $db->query($updatePass, [
                'password' => $hash,
                'id' => $id,
            ]);
        }

        $data = [
            'firstname' => $this->request->getPost('firstname', FILTER_SANITIZE_SPECIAL_CHARS),
            'middlename' => $this->request->getPost('middlename', FILTER_SANITIZE_SPECIAL_CHARS),
            'lastname' => $this->request->getPost('lastname', FILTER_SANITIZE_SPECIAL_CHARS),
            'contact' => $this->request->getPost('contact', FILTER_SANITIZE_NUMBER_INT),
            'address' => $this->request->getPost('address', FILTER_SANITIZE_SPECIAL_CHARS),
            'gender' => $this->request->getPost('gender', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
        ];

        $updateCustomer->update($id, $data);

        return redirect()->to(base_url('admin/customer-management'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Customer updated successfully')
            ->with('status', 'Success');

    }
}
