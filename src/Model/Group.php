<?php

namespace Luminee\Watchdog\Model;

class Group extends _BaseModel
{
    protected $table = 'watchdog_group';

    protected $fillable = ['code', 'label', 'parent_id', 'is_leaf', 'sort'];

}
