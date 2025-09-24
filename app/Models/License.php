<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{

    use HasFactory;

    protected $fillable = ['code', 'buyer_name', 'buyer_email', 'company', 'status', 'max_activations', 'support_until', 'meta'];

    protected $casts = ['support_until' => 'datetime', 'meta' => 'array'];

    public function activations(){
        return $this->hasMany(LicenseActivation::class);
    }
    
}
