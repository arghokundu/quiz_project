<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mcq\McqModel;

class AdminModel extends Model
{
    use HasFactory;

    protected $table='admin';
    protected $primaryKey='admin_id';
    public $keyType='int';
    public $incrementing=true;
    public $timesstamps=false;

    public function mcq()
    {
        return $this->hasMany(McqModel::class,'admin_id_fk','admin_id');
    }
}
