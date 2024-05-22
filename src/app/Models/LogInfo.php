<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInfo extends Model
{
    use HasFactory;
    protected $table = 'log_info';
    protected $fillable = [
        'user_id',
        'service',
        'body_req',
        'http_response',
        'ip_address',
        'user_agent',
        'url',
        'description'
    ];

    public function logInfo(){
        return $this->belongsTo(User::class);
    }
}
