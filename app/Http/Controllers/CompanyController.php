<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{

    public function index()
    {
        $data = Company::orderBy('id', 'desc')->get();
        return Inertia::render('Company/Index', [
            'companies' => $data
        ]);
    }
    public function store(Request $request)
    {
        Company::create([
            'commercial_name' => $request->commercial_name,
            'social_reason' => $request->social_reason,
            'address' => $request->address,
            'cellphone' => $request->cellphone,
            'telephone' => $request->telephone,
            'nrc' => $request->nrc,
            'nit' => $request->nit,
            'business_line' => $request->business_line,
            'agency' => $request->agency,
        ]);

        return redirect()->to('/companies');
    }

    public function update(Request $request, Company $Company)
    {
        $Company->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'nrc' => $request->nrc,
            'nit' => $request->nit,
            'business_line' => $request->business_line,
            'agency' => $request->agency,
        ]);

        return redirect()->to('/companies');
    }

    public function destroy(Company $Company)
    {
        $Company->delete();

        return redirect()->to('/companies');
    }
}
