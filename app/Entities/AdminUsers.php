<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class AdminUsers extends Model implements Transformable
class AdminUsers extends Authenticatable implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'user_info_id',
        'privileges',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];

    public function info()
    {
      return $this->belongsTo('App\Entities\UserInfos', 'user_info_id');
    }

}
