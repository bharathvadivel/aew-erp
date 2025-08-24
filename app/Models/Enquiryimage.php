<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiryimage extends Model
{
    use HasFactory;

       public function scopeEnquiryImage($query, $image)
    {
        return url('/application/service') . '/' . $image;
    }
}
