<?php

namespace Luminee\Watchdog\Model;

use Illuminate\Database\Eloquent\Model;

class AccountRole extends Model
{
    protected $table = 'watchdog_account_role';
    
    protected $fillable = ['account_id', 'role_id'];
    
    public function role()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Role', 'role_id', 'id');
    }
    
}
