<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class userRecordModel extends Model
{
    use HasFactory;
    protected $table='user_records_details';
    protected $primaryKey='userRecord_id';
    public $keyType='int';
    public $incrementing=true;
    public $timesstamps=false;
}
