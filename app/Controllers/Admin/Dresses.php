<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DressModel;

class Dresses extends BaseController
{

    public function store()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

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

        $styles = $this->request->getPost('style') ?? [];
        $sizes = $this->request->getPost('sizes') ?? [];

        $colorsString = trim($this->request->getPost('colors'));
        $colors = [];

        if (!empty($colorsString)) {
            $colors = array_map('trim', explode(',', $colorsString));
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'cat' => $this->request->getPost('cat'),
            'price' => $this->request->getPost('price'),
            'old_price' => $this->request->getPost('old_price'),
            'badge' => $this->request->getPost('badge'),

            'style' => json_encode($styles),
            'sizes' => json_encode($sizes),
            'colors' => json_encode($colors),

            'img' => $fileName,
        ];

        $dressModel = new DressModel();
        $dressModel->insert($data);

        return redirect()->to('/admin/dresses');
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $model = new DressModel();

        $dress = $model->find($id);

        if (!$dress) {
            return redirect()->to('/admin/dresses')
                ->with('error', 'Dress not found');
        }

        // -------------------------
        // COLLECT FORM DATA
        // -------------------------
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'cat' => $this->request->getPost('cat'),
            'price' => $this->request->getPost('price'),
            'old_price' => $this->request->getPost('old_price'),
            'badge' => $this->request->getPost('badge'),
            'reviews' => $this->request->getPost('reviews') ?? 0,
        ];

        // -------------------------
        // JSON FIELDS
        // -------------------------
        $data['style'] = json_encode($this->request->getPost('style') ?? []);
        $data['sizes'] = json_encode($this->request->getPost('sizes') ?? []);

        // colors comes as comma string → convert to JSON array
        $colors = $this->request->getPost('colors');

        if (!empty($colors)) {
            $colorArray = array_filter(array_map('trim', explode(',', $colors)));
            $data['colors'] = json_encode($colorArray);
        } else {
            $data['colors'] = json_encode([]);
        }

        // -------------------------
        // IMAGE UPLOAD
        // -------------------------
        $file = $this->request->getFile('img');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $newFileName = uniqid('dress_') . '.jpg';

            \Config\Services::image()
                ->withFile($file)
                ->fit(250, 350, 'center')
                ->save(
                    FCPATH . 'uploads/dresses/' . $newFileName,
                    85
                );

            // delete old image (important cleanup)
            if (!empty($dress['img']) && file_exists(FCPATH . 'uploads/dresses/' . $dress['img'])) {
                unlink(FCPATH . 'uploads/dresses/' . $dress['img']);
            }

            $data['img'] = $newFileName;
        }

        // -------------------------
        // UPDATE QUERY
        // -------------------------
        $model->update($id, $data);

        return redirect()->to('/admin/dresses')
            ->with('success', 'Dress updated successfully');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $model = new DressModel();

        $dress = $model->find($id);

        if (!$dress) {
            return redirect()->to('/admin/dresses')
                ->with('error', 'Dress not found');
        }

        // delete image
        if (
            !empty($dress['img']) &&
            file_exists(FCPATH . 'uploads/dresses/' . $dress['img'])
        ) {
            unlink(FCPATH . 'uploads/dresses/' . $dress['img']);
        }

        // delete record
        $model->delete($id);

        return redirect()->to('/admin/dresses')
            ->with('success', 'Dress deleted successfully');
    }

}