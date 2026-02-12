<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class HomePage extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'hero_terminal' => 'object',
        'about' => 'object',
        'stats' => 'object',
        'techs' => 'object',
        'principles' => 'object',
        'setup' => 'object',
    ];
}
