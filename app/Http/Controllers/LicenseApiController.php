<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Support\Licenses;
use App\Mail\LicenseCodeMail;
use Illuminate\Support\Facades\Mail;

class LicenseApiController extends Controller
{

    public function claim(Request $request)
    {
        $data = $request->validate([

            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'company' => 'nullable|string|max:120',
            'price' => 'nullable|numeric|min:0',
        ]);

        $code = Licenses::unique();

        $lic = License::create([
            'code' => $code,
            'buyer_email' => $data['email'],
            'buyer_name' => $data['name'],
            'company' => $data['company'],
            'status' => 'active',
            'max_activations' => 1,
            'support_until' => now()->addYear(),
            'meta' => ['price' => $data['price'] ?? null]
        ]);

        Mail::to($lic->buyer_email)->send(new LicenseCodeMail($lic->code, $lic->buyer_name));

        return response()->json(['ok' => true, 'code' => $lic->code,], 201);
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'purchase_code' => 'required|string',
            'domain' => 'nullable|string|max:255',
            'app_url' => 'nullable|string|max:255',
        ]);

        $lic = License::where('code', $data['purchase_code'])->first();

        if(!$lic) return response()->json(['valid' => false, 'message' => 'License not found'], 404);

        if($lic->status == 'active') return response()->json(['valid' => false, 'message' => $lic->status], 403);

        return response()->json([
                'valid' => true, 
                'message' => $lic->status,
                'support_until' => $lic->support_until->toDateTimeString(),
                200
            ]);
    }
    
}
