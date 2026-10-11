<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\Factories\HasFactory;

class AdminModel extends Model
{
    use HasFactory;

    protected $table='admin';
    protected $primaryKey='admin_id';
    public $keyType='int';
    public $incrementing=true;
    public $timesstamps=false;
}
