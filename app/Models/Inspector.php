<?php

namespace App\Models;

use App\Models\Url;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspector extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}
