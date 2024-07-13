<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugPrescriptionRX extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'prescription_id', 
        'drug_id',
        'pharmacy_id',
        'dosage',
        'frequency',
        'duration', 
        'isFilled', //boolean
        'isSubstituted', // boolean 
        'substitution_id', // id of drug that was used to substitute this
        'isTransferred',
        'substitutedBy_id',
        'deleted_by'
    ];
}
