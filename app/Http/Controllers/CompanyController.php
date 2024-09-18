<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $data = Company::orderBy('id', 'desc')->get();

        return Inertia::render('Company/Index', [
            'companies' => CompanyResource::collection($data),
        ]);
    }

    public function store(CompanyRequest $request)
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
            'agency' => 'Color Digital',
        ]);

        return redirect()->route('companies');
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company->update([
            'commercial_name' => $request->commercial_name,
            'social_reason' => $request->social_reason,
            'address' => $request->address,
            'cellphone' => $request->cellphone,
            'telephone' => $request->telephone,
            'nrc' => $request->nrc,
            'nit' => $request->nit,
            'business_line' => $request->business_line,
            'agency' => 'Color Digital',
        ]);

        return redirect()->route('companies');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies');
    }
}
