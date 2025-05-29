<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
class ContactController extends Controller
{
    public function show( ): InertiaResponse
    {
      return Inertia::render('Contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with(['success'=>'Your message has been sent successfully.']);
    }
}