<?php

namespace Luminee\Watchdog\Model;

use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    protected $table = 'watchdog_power';
    
    protected $fillable = ['group', 'group_label', 'module', 'module_label', 'operation', 'operation_label','route'];
    
}
