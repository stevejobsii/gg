<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application as Application;

class MaterialController extends Controller
{

    public function __construct(Application $material)
    {
        $this->material = $material;
    }

    public function materials()
    {
        $materials = $this->material->lists('news');
        return $materials;
    }

    public function images()
    {
        //
    }
}
