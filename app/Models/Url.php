<?php

namespace App\Models;

use App\Models\Inspector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    function inspectors()
    {
        return $this->hasMany(Inspector::class);
    }

    public function getClicksAttribute()
    {
        return $this->inspectors()->count();
    }


    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
