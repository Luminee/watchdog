<?php

namespace Luminee\Watchdog\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'watchdog_role';
    
    protected $fillable = ['label', 'power_ids', 'is_active'];
    
}
