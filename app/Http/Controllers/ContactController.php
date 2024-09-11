<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(){
        return Inertia::render('Contact/Index', [
            'contacts' => Contact::orderBy('id', 'desc')->get(),
            'countries' => Country::orderBy('id', 'desc')->get(),
            'companies' => Company::orderBy('id', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = Contact::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'cellphone' => $request->cellphone,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'country_id' => $request->country_id,
        ]);
        return redirect()->route('contacts');
    }
}
