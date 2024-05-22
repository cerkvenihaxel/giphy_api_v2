<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedGifs extends Model
{
    use HasFactory;
    protected $table = 'saved_gifs';

    protected $fillable = [
      'users_id',
      'gif_id',
      'alias'
    ];

    public function savedGifs(){
        return $this->belongsTo(User::class);
    }
}
