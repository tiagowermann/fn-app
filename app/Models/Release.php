<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'value',
        'type',
        'description',
        'id_user'
    ];
}
