<?php

namespace Luminee\Watchdog\Model;

use Luminee\Base\Models\BaseModel;

class Role extends BaseModel
{
    protected $table = 'watchdog_role';

    protected $fillable = ['code', 'label', 'is_active', 'sort'];

}
