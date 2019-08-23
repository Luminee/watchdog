<?php

namespace Luminee\Watchdog\Model;

use Luminee\Base\Models\BaseModel;

class RolePower extends BaseModel
{
    protected $table = 'watchdog_role_power';

    protected $fillable = ['role_id', 'power_id'];

    public function role()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Role', 'role_id', 'id');
    }

    public function power()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Power', 'power_id', 'id');
    }

}
