<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    /**
     * 
     * attributes that are mass assignable
     * @var array<string, int>
     * 
     */
    // drugs can not be deleted, can be updated, but not deleted
    protected $fillable = [
        'drug_name',
        'drug_type',
        'drug_form', //capsule, syrup etc
        'price',
        'prescription_required',
    ];
}