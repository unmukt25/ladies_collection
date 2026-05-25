<?php

namespace App\Controllers;

use App\Models\DressModel;
class DressesController extends BaseController
{
    public function all_dresses()
    {

        $model = new DressModel();

        $dresses = $model->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }

    public function casual()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('cat', 'Casual')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }
    
    public function evening()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('cat', 'Evening')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }

    
    public function bridal()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('cat', 'Bridal')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }


    public function party()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('cat', 'party')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }

    public function office_wear()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('cat', 'office')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }

    public function sale()
    {

        $model = new DressModel();

        $dresses = $model
            ->where('badge', 'sale')
            ->findAll();

        // decode json fields
        foreach ($dresses as &$dress) {

            $dress['style'] =
                json_decode($dress['style'], true);

            $dress['colors'] =
                json_decode($dress['colors'], true);

            $dress['sizes'] =
                json_decode($dress['sizes'], true);

            // frontend expects old
            $dress['old'] = $dress['old_price'];

            // frontend expects rev
            $dress['rev'] = $dress['reviews'];
        }

        return $this->response->setJSON($dresses);
    }




}