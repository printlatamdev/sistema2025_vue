<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('id', 'desc')->get();
        return Inertia::render('Contact/Index', [
            'contacts' => ContactResource::collection($contacts),
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

    public function update(Request $request, Contact $contact)
    {
        $contact->update([
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

    public function destroy(Contact $contact){
        $contact->delete();
        return redirect()->route('contacts');
    }
}
