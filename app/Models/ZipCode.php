<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $fillable = [
        'zip_code',
        'locality_id',
        'federal_entity_id',
        'municipality_id'

      ];
}
