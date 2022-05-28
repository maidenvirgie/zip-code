<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = [
        'name',
        'zone_type',
        'settlement_type',
        'zip_code',
        'key',
      ];

    protected $table = 'settlements';
}
