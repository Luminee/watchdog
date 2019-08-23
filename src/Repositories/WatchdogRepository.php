<?php

namespace Luminee\Watchdog\Repositories;

use Luminee\Base\Repositories\BaseRepository;

class WatchdogRepository extends BaseRepository
{
    public function __construct()
    {
        $this->db_models_path = realpath(__DIR__ . '/../Model');
    }

    /**
     * @param $account_id
     * @return array
     */
    public function getRoleIdsByAccountId($account_id)
    {
        return $this->setModel('accountRole')->where('account_id', $account_id)->listField('role_id')->toArray();
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->setModel('power')->listField('route')->toArray();
    }

    /**
     * @param $power_ids
     * @return array
     */
    public function getRoutesByPowerIds($power_ids)
    {
        return $this->setModel('power')->whereIn('id', $power_ids)->listField('route')->toArray();
    }

    /**
     * @param $role_ids
     * @param $account_id
     * @return array
     */
    public function getAccountPowerIds($role_ids, $account_id)
    {
        $role_powers = $this->setModel('rolePower')->whereIn('role_id', $role_ids)->listField('power_id')->toArray();
        $other_powers = $this->setModel('accountPower')->where('account_id', $account_id)->getCollection();
        $remove = [];
        foreach ($other_powers as $other) {
            $other->is_addition == 1 ? $role_powers[] = $other->power_id : $remove[] = $other->power_id;
        }
        $ids = [];
        foreach ($role_powers as $id) {
            if (!in_array($id, $remove)) $ids[] = $id;
        }
        return $ids;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insertPower($data)
    {
        return $this->setModel('power')->insert($data);
    }
}