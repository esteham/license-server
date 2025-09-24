<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LicenseActivation extends Model
{

    use HasFactory;

    protected $fillable = ['license_id', 'domain', 'app_url', 'fingerprint', 'activated_at', 'deactivated_at'];

    protected $casts = ['activated_at' => 'datetime', 'deactivated_at' => 'datetime'];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
    
}
