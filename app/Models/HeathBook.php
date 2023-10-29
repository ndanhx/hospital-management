<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeathBook extends Model
{
    use HasFactory;
    protected $fillable = ['STT','user_id', 'diagnosis','doctor_id'];
}
