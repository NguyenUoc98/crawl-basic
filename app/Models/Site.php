<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Site extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'name',
        'url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
