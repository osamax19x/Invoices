<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'Product_name',
        'section_id',
        'description',
    ];
 public function section()
    {
        return $this->belongsTo(sections::class);
    }
}
