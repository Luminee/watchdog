<?php

namespace Luminee\Watchdog\Model;

use Illuminate\Database\Eloquent\Model;

class _BaseModel extends Model
{
    private $account = '';

    /**
     * @return string
     */
    protected function getAccountModel()
    {
        if (empty($this->account)) {
            $this->account = config('watchdog.account.model');
        }
        return $this->account;
    }
}
