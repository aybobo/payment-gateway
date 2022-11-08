<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_on_card',
        'card_number',
        'cvc',
        'expire_month',
        'expire_year',
    ];
}
