<?php

namespace Luminee\Watchdog\Model;

use Luminee\Base\Models\BaseModel;

class Group extends BaseModel
{
    protected $table = 'watchdog_group';

    protected $fillable = ['code', 'label', 'parent_id', 'is_leaf', 'sort'];

}
