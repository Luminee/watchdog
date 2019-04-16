<?php

namespace Luminee\Watchdog\Model;

class Power extends _BaseModel
{
    protected $table = 'watchdog_power';

    protected $fillable = ['group_id', 'action', 'label', 'route', 'sort'];

    public function group()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Group', 'group_id', 'id');
    }

}
