<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtTujuan extends Model
{
    use HasFactory,HasUuids;

    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false;

    
}
