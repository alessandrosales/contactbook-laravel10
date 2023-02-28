<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Contact::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newContact = Contact::create($request->all());
        return $newContact;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        
        if (!$contact) {
            abort(response()->json(['message' => 'Record not found.'], 404));
        }

        return $contact;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = $this->show($id);
        $contact->fill($request->all());
        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = $this->show($id);
        $contact->delete();

        return response()->noContent();
    }
}
