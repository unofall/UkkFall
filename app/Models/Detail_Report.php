<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    function reports(){
        return $this->belongsTo(Report::class,'reports_id');
    }


}
