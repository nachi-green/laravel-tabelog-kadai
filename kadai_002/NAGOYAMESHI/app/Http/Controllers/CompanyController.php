<?php

namespace App\Http\Controllers;

use App\Models\Companyinfo;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyinfo = Companyinfo::all();
        
        return view('company.index', compact('companyinfo'));
    }

}
