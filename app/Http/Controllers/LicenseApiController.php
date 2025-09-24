<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Support\Licenses;
use App\Mail\LicenseCodeMail;
use Illuminate\Support\Facades\Mail;

class LicenseApiController extends Controller
{
    /**
     * Create/claim a license and email the code.
     */
    public function claim(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email',
            'company' => 'nullable|string|max:120',
            'price'   => 'nullable|numeric|min:0',
        ]);

        $code = Licenses::unique(); 

        $lic = License::create([
            'code'            => $code,
            'buyer_email'     => $data['email'],
            'buyer_name'      => $data['name'],
            'company'         => $data['company'] ?? null,  
            'status'          => 'active',                   
            'max_activations' => 1,
            'activations'     => 0,                           
            'support_until'   => now()->addYear(),
            'meta'            => ['price' => $data['price'] ?? null],
        ]);


        try {
            Mail::to($lic->buyer_email)->send(
                new LicenseCodeMail($lic->code, $lic->buyer_name)
            );
        } catch (\Throwable $e) {
            \Log::warning('Mail send failed: '.$e->getMessage());
        }

        return response()->json([
            'ok'            => true,
            'code'          => $lic->code,
            'status'        => $lic->status,
            'support_until' => $lic->support_until->toDateTimeString(),
        ], 201);
    }

    
    public function verify(Request $request)
    {
        $data = $request->validate([
            'purchase_code' => 'required|string',
            'domain'        => 'nullable|string|max:255',
            'app_url'       => 'nullable|string|max:255',
        ]);

        $lic = License::where('code', $data['purchase_code'])->first();

        if (!$lic) {
            return response()->json(['valid' => false, 'message' => 'License not found'], 404);
        }

        $domain  = $data['domain']  ?? null;
        $app_url = $data['app_url'] ?? null;


        if ($lic->status === 'pending') {
            
            if ($lic->activations >= $lic->max_activations) {
                return response()->json([
                    'valid'   => false,
                    'message' => 'Activation limit reached',
                ], 403);
            }

            $lic->status       = 'active';
            $lic->activations  = ($lic->activations ?? 0) + 1;
            $lic->last_domain  = $lic->last_domain ?? $domain;
            $lic->last_app_url = $lic->last_app_url ?? $app_url;
            $lic->last_verified_at = now();
            $lic->save();
        }

        if ($lic->status === 'active') {
            return response()->json([
                'valid'         => true,
                'message'       => $lic->status,
                'support_until' => optional($lic->support_until)->toDateTimeString(),
                'domain'        => $lic->last_domain ?? null,
                'app_url'       => $lic->last_app_url ?? null,
            ], 200);
        }

        return response()->json([
            'valid'   => false,
            'message' => $lic->status,
        ], 403);
    }
}
