<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Asm extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
        'asm_id','name','email','dob','proof','phone','password','address','pin_code','district','city','state','country','created_id','status'
     ];

            public function scopeProof($query, $image)
    {
        return url('/application/asm') . '/' . $image;
    }

    /**
     *ASM get direct partner
     */
    public function partners()
    {
      return $this->hasMany(Listdisid::class, 'asm_id', 'asm_id');
    }
}
