<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKontak extends Model
{
    use HasFactory;

    protected $fillable=['nama','no_hp','email','facebook'];
}
