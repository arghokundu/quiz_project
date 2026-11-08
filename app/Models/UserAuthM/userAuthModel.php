<?php

namespace App\Models\UserAuthM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userAuthModel extends Model
{
    use HasFactory;
    protected $table='user_details';
    protected $primaryKey='user_id';
    public $keyType='int';
    public $incrementing=true;
    public $timesstamps=false;
}
