<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartorderList extends Model
{
    use HasFactory;
    protected $fillable = [
      'partorder_id','call_id','part_code','part_name','fulfillment_status'
    ];
}