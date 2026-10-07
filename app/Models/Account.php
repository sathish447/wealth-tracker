<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Model
{
        use SoftDeletes;

    protected $fillable = [
        'organization_id',
        'user_id',
        'name',
        'account_type',
        'institution_name',
        'account_number',
        'opening_balance',
        'current_balance',
        'is_active',
        'notes'
    ];

    public function organization()
{
    return $this->belongsTo(Organization::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
