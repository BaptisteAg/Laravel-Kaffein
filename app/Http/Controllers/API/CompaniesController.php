<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Companies;

class CompaniesController extends Controller
{
    // Get all companies (fields : name, activity, country, town)
    public function index()
    {
        $companies = Companies::all()->toArray();
        return array_reverse($companies);
    }

    // Get company details for popup (fields : website, phone, zipcode, nbemployees, netsales)
    public function details($id)
    {
        $details = Companies::find(1)->details;
        return response()->json($details);
    }
}
