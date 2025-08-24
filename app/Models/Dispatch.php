<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;
    protected $table = 'dispatchs'; // Define the correct table name
    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'customer_id',
        'client_note',
        'status'
    ];
}
