<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugBatch extends Model
{
    use HasFactory;

    /**
     * 
     * attributes that are mass assignable
     * @var array<string, int>
     * 
     */
    protected $fillable = [
        'batch_name', // batch name should be descriptive e.g PCM APRIL 2024
        'manufacture_date',
        'expiration_date',
        'manufacturer',
        'quantity',
        'drug_id',
        'staff_id',
        'updatedBy_id', // points to the staff who made the last changes to this drug
        'deletedBy_id' // points to the staff who soft deleted this drugs
    ];

}
