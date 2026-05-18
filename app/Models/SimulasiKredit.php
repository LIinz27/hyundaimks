<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulasiKredit extends Model
{
    protected $fillable = ['nama', 'telepon', 'kota', 'tipe_mobil', 'tenor', 'uang_muka'];
}
