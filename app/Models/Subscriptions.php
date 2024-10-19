<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    // protected $primaryKey ="plan_id";
    protected $fillable = [
        "user_id",
        "type",
        "name",
        "stripe_id",
        "stripe_status",
        "stripe_price",
        "quantity",
        "trial_ends_at",
        "ends_at",
        "subscription_ends_at",
    ];
}
