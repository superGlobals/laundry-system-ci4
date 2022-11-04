<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaundrySevicesModel;
use App\Models\TransactionModel;

class TransactionController extends BaseController
{

    /**
     * Activate the helper and create function in helper folder
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $laundry_service = new LaundrySevicesModel();
        $data['laundry'] = $laundry_service->where('laundry_service_status', 'available')->findAll();

        return view('admin/new-laundry', $data);
    }

    /**
     * Save laundry transaction
     */
    public function laundryTransaction($id = null)
    {
        $laundry = new LaundrySevicesModel();
        $data['laundry'] = $laundry->find($id);

        return view('admin/laundry-transaction', $data);
    }

    /**
     * Save customer laundry transaction
     */
    public function storeLaundryTransaction($id = null)
    {
        $validated = $this->validate([
            'customer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Customer Name is required',
                ]
            ],

            'laundry_weight' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Laundry Weight is required',
                    'alpha_numeric' => 'Laundry Weight can contain numbers only'
                ]
            ],

            'payment_type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Payment Type is required',
                ]
            ],

        ]);
        $laundry = new LaundrySevicesModel();
        $data['laundry'] = $laundry->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/laundry-transaction', $data);
        }

        $data = [
            'transaction_id' => 'TID-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 7)),
            'laundry_service_id' => $id,
            'customer_id' => $this->request->getPost('customer', FILTER_SANITIZE_SPECIAL_CHARS),
            'transaction_payment_type' => $this->request->getPost('payment_type', FILTER_SANITIZE_SPECIAL_CHARS),
            'customer_total_bill' => $this->request->getPost('total_bill'),
        ];

        $transaction = new TransactionModel();
        $save = $transaction->insert($data);

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
            ->with('status_text', 'Transaction added successfully')
            ->with('status', 'Success');
        }
    }
}
