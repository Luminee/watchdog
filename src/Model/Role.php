<?php

namespace Luminee\Watchdog\Model;

class Role extends _BaseModel
{
    protected $table = 'watchdog_role';

    protected $fillable = ['code', 'label', 'is_active', 'sort'];

}
