<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Models\Contact;
class ContactController extends Controller
{  
 public function store(Request $request)
{
    $validated = $request->validate([
        'inquiryType' => 'required|string',
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'location' => 'nullable|string',
        'message' => 'required|string',
    ]);

    // Store the contact data in the database
    Contact::create($validated);

    // Send the email
    Mail::to(config('mail.from.address'))->send(new ContactUsMail($validated));

    return response()->json(['message' => 'Message sent successfully'], 200);
}
}
