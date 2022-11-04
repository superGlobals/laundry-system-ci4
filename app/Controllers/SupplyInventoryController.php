<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupplyInventoryModel;

class SupplyInventoryController extends BaseController
{   
    /**
     * Activate the helper and create function in helper folder
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Show supply inventory
     */
    public function index()
    {   
        $supply = new SupplyInventoryModel();
        $data['supplies'] = $supply->findAll();

        return view('admin/supply-inventory', $data);
    }

    /**
     * Store supply in database
     */
    public function storeSupply()
    {
        $validated = $this->validate([
            'supply_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Supply Name is required',
                    'alpha_space' => 'Supply Name cannot accept numbers and symbols'
                ]
            ],

            'supply_qty' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Supply Quantity is required',
                    'alpha_numeric' => 'Supply Quantity can contain numbers only'
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/supply-inventory', ['validation' => $this->validator]);
        }

        // check if image has value
        if($img = $this->request->getFile('supply_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // assign variable to hold the value of image
        if(!empty($_FILES['supply_image']['name']))
        {
            $imageSupply = $imageName;
        }
        else
        {
            $imageSupply = "no_image.jpg";
        }

        $data = [
            'supply_name' => $this->request->getPost('supply_name', FILTER_SANITIZE_SPECIAL_CHARS),
            'supply_qty' => $this->request->getPost('supply_qty', FILTER_SANITIZE_NUMBER_INT),
            'supply_id' => 'SID-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)),
            'supply_image' => $imageSupply,
        ];

        $supply = new SupplyInventoryModel();
        $save = $supply->insert($data);

        if(!$save)
        {
            return redirect()->to(base_url('admin/supply-inventory'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving supply')
            ->with('status', 'error');
        }
        else
        {
            return redirect()->to(base_url('admin/supply-inventory'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Supply added successfully')
            ->with('status', 'Success');
        }
    }

    /**
     * Update supply in database
     */
    public function updateSupply($id = null)
    {   
        $updateSupply = new SupplyInventoryModel();
        $db = db_connect();

        if($img = $this->request->getFile('supply_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $supplyImage = $updateSupply->find($id);
        $supply_image = $supplyImage->supply_image;

        // update user supply_image
        if(!empty($_FILES['supply_image']['name']))
        {
            if($supply_image != "no_image.jpg")
            {
                unlink("uploads/".$supply_image);
                $updatesupply_image = "UPDATE tbl_supply SET supply_image = :supply_image: WHERE id = :id: LIMIT 1";
                $db->query($updatesupply_image, [
                    'supply_image' => $imageName,
                    'id' => $id,
                ]);
            }
            else{
                $updatesupply_image = "UPDATE tbl_supply SET supply_image = :supply_image: WHERE id = :id: LIMIT 1";
                $db->query($updatesupply_image, [
                    'supply_image' => $imageName,
                    'id' => $id,
                ]);
            }
        }

        $data = [
            'supply_name' => $this->request->getPost('supply_name', FILTER_SANITIZE_SPECIAL_CHARS),
            'supply_qty' => $this->request->getPost('supply_qty', FILTER_SANITIZE_NUMBER_INT),
        ];

        $updateSupply->update($id, $data);

        return redirect()->to(base_url('admin/supply-inventory'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Supply updated successfully')
            ->with('status', 'Success');

    }

    /**
     * Delete supply in database
     */
    public function deleteSupply($id = null)
    {
        $supply = new SupplyInventoryModel();
        $supply_image = $supply->find($id);

        $supplyImage = $supply_image->supply_image;

        if($supplyImage == "no_image.jpg")
        {
            $supply->delete($id);
        }
        else
        {
            unlink("uploads/".$supplyImage);
            $supply->delete($id);
        }

        $data = [
            'status' => 'Success',
            'status_text' => 'Supply Deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
