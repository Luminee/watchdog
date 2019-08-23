<?php

namespace Luminee\Watchdog\Model;

use Luminee\Base\Models\BaseModel;

class AccountLevel extends BaseModel
{
    protected $table = 'watchdog_account_level';

    protected $fillable = ['code', 'label', 'account_id', 'parent_id', 'is_active', 'sort'];

    public function account()
    {
        return $this->belongsTo($this->getAccountModel(), 'account_id', 'id');
    }

}
