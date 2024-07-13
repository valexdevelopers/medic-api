<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugDrugBatch extends Model
{
    // this is a model for a many to many table between drugs and their batches
    // this maps a drugs and the batch its belongs to
    // a single drug can be in many batches and many batch contain different drugs
    use HasFactory;
}
