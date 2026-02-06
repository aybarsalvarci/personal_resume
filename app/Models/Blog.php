<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
}
