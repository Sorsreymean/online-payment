<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $table = 'plans';
    // protected $primaryKey ="plan_id";
    protected $fillable = [
        "plan_id",
        "name",
        "billing_method",
        "interval_count",
        "price",
        "currency",
    ];
}
