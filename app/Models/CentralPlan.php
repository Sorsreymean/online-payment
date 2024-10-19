<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentralPlan extends Model
{
    use HasFactory;
    protected $table = 'central_plan';
    protected $primaryKey ="plan_id";
    protected $fillable = [
        "stripe_plan_id",
        "name",
        "price",
        "currency",
        "features",
        "bill_period",
        "period",
        "created_by",
        "updated_by"
    ];
}
