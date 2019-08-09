<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 
        'cep',
        'street', 
        'number',
        'neighborhood',
        'city',
        'state'
   ];

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
