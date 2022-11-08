<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_id',
        'trans_name',
        'narration',
        'amount',
        'transaction_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
