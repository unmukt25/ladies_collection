<?php

namespace App\Controllers;
use App\Models\DressModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('homepage');
    }

    //Home.php controller method
public function dress_details($id)
{
    $dressModel = new DressModel();

    $dress = $dressModel->find($id);

    if (!$dress) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $data['dress'] = $dress;

    return view('dress_details', $data);
}

}
