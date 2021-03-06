<?php

namespace Luminee\Watchdog\Model;

use Luminee\Base\Models\BaseModel;

class AccountRole extends BaseModel
{
    protected $table = 'watchdog_account_role';

    protected $fillable = ['account_id', 'role_id'];

    public function account()
    {
        return $this->belongsTo($this->getAccountModel(), 'account_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Role', 'role_id', 'id');
    }

}
