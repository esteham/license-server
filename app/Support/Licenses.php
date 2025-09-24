<?php

namespace App\Support;

use App\Models\License;
use Illuminate\Support\Str;

class Licenses
{
    
    public static function randomCode(int $segments = 4, int $len = 4): string
    {
        $parts = [];

        for($i=0; $i<$segments; $i++) 
        {
            $raw = strtoupper(bin2hex(random_bytes(intval(ceil($len / 2)))));
            $parts[] = substr(strtr($raw, 'SPDR', 'XXXX'), 0, $len);
        }

        return 'LIC-'.implode('-', $parts);
    }

    public static function unique(int $tries = 5): string
    {
        for($i=0; $i<$tries; $i++) 
        {
            $code = self::randomCode();
            if(!License::where('code', $code)->exists()) return $code;
        }

        return strtoupper(Str::uuid());
    }
    
}
