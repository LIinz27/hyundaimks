<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesProfile extends Model
{
    protected $fillable = ['nama', 'jabatan', 'foto', 'telepon', 'whatsapp', 'keunggulan'];
    protected $casts    = ['keunggulan' => 'array'];
}
