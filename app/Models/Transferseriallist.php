<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferseriallist extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_no','transferserial_id','from_warehouse_id','to_warehouse_id','serial_no','status'
       ];
}
