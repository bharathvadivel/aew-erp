<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'fy_id',
        'invoice_no',
        'dc_no',
        'inward_invoice_no',
        'inward_dc_no',
        'assembly_bill_no',
        'machine_bill_no',
        'routing_no',
        'loss_no',
    ];
}