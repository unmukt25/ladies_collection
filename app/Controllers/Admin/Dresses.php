<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DressModel;

class Dresses extends BaseController
{

    public function store()
    {
        
        $file = $this->request->getFile('img');

        $fileName = '';

        if ($file && $file->isValid()) {
            $fileName = uniqid('dress_') . '.jpg';

            \Config\Services::image()
                ->withFile($file)
                ->fit(
                    250,
                    350,
                    'center'
                )
                ->save(
                    FCPATH . 'uploads/dresses/' . $fileName,
                    85
                );
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'cat' => $this->request->getPost('cat'),
            'price' => $this->request->getPost('price'),
            'old_price' => $this->request->getPost('old_price'),
            'badge' => $this->request->getPost('badge'),
            'img' => $fileName,
        ];

        $dressModel = new DressModel();
        $dressModel->insert($data);

        return redirect()->to('/admin/dresses');
    }

}