<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
     protected $fillable = [
        'user_id',
        'card_number',
        'name_on_card',
        'expiry_date',
        'cvv',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
