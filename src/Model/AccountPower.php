<?php

namespace Luminee\Watchdog\Model;

class AccountPower extends _BaseModel
{
    protected $table = 'watchdog_account_power';

    protected $fillable = ['account_id', 'power_id', 'is_addition'];

    public function account()
    {
        return $this->belongsTo($this->getAccountModel(), 'account_id', 'id');
    }

    public function power()
    {
        return $this->belongsTo('Luminee\Watchdog\Model\Power', 'power_id', 'id');
    }

}
