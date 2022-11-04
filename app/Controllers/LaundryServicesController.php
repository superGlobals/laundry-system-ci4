<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;
use App\Models\LaundrySevicesModel;

class LaundryServicesController extends BaseController
{   

    /**
     * Activate the helper and create function in helper folder
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Show laundry services pages
     */
    public function index()
    {   
        $laundry_service = new LaundrySevicesModel();
        $data['laundry_services'] = $laundry_service->findAll();

        return view('admin/laundry-services', $data);
    }

    /**
     * Save laundry service info in database
     */
    public function storeLaundryService()
    {
        $validated = $this->validate([
            'laundry_service_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Laundry Service Name is required',
                ]
            ],

            'laundry_service_price' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Laundry Price is required',
                    'alpha_numeric' => 'Laundry Price can contain numbers only'
                ]
            ],

        ]);

        $laundry_service = new LaundrySevicesModel();
        $data['laundry_services'] = $laundry_service->findAll();
        $data['validation'] = $this->validator;
        if(!$validated)
        {
            return view('admin/laundry-services', $data);
        }

        // check if image has value
        if($img = $this->request->getFile('laundry_service_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // assign variable to hold the value of image
        if(!empty($_FILES['laundry_service_image']['name']))
        {
            $laundry_image = $imageName;
        }
        else
        {
            $laundry_image = "no_image.jpg";
        }

        $data = [
            'laundry_service_name' => $this->request->getPost('laundry_service_name', FILTER_SANITIZE_SPECIAL_CHARS),
            'laundry_service_price' => $this->request->getPost('laundry_service_price', FILTER_SANITIZE_NUMBER_INT),
            'laundry_service_status' => $this->request->getPost('laundry_service_status', FILTER_SANITIZE_SPECIAL_CHARS),
            'laundry_service_image' => $laundry_image,
        ];


        $laundry_service = new LaundrySevicesModel();
        $save = $laundry_service->insert($data);

        $logs = [
            'name' => 'Squidward',
            'action' => 'Add New Laundry Service',
        ];

        $activity_log = new ActivityLogModel();
        $activity_log->insert($logs);

        if(!$save)
        {
            return redirect()->to(base_url('admin/laundry-services'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving laundry service')
            ->with('status', 'error');
        }
        else
        {
            return redirect()->to(base_url('admin/laundry-services'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Laundry service added successfully')
            ->with('status', 'Success');
        }
    }

    /**
     * Delete laundry service in database
     */
    public function deleteLaundryService($id = null)
    {
        $delete_laundry_service = new LaundrySevicesModel();
        $laundry_image = $delete_laundry_service->find($id);

        $laundry_service_image = $laundry_image->laundry_service_image;

        if($laundry_service_image == "no_image.jpg")
        {
            $delete_laundry_service->delete($id);
        }
        else
        {
            unlink("uploads/".$laundry_service_image);
            $delete_laundry_service->delete($id);
        }

        $data = [
            'status' => 'Success',
            'status_text' => 'Laundry Service Deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
