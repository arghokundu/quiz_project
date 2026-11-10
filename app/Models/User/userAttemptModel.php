<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class userAttemptModel extends Model
{
    use HasFactory;
    protected $table='user_attempts_dtl';
    protected $primaryKey='attempt_id';
    public $keyType='int';
    public $incrementing=true;
    public $timesstamps=false;
}
