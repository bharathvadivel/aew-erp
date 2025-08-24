<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimage extends Model
{
    use HasFactory;

          public function scopeModelImage($query, $image)
    {
        return url('/application/model') . '/' . $image;
    }
}
