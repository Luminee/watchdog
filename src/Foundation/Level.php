<?php

namespace Luminee\Watchdog\Foundation;

use Luminee\Watchdog\Model\AccountLevel;

trait Level
{
    protected $levels;

    protected $tree;

    /**
     * @param $account_id
     * @return array
     */
    public function getSelfLevel($account_id)
    {
        $level = AccountLevel::where('account_id', $account_id)->where('is_active', 1)->first();
        if (empty($level)) return [];
        $this->allLevel();
        $self = $this->getParent($level->id);
        $self['child'] = $this->searchTree($this->buildTree(0), $level->id)['child'];
//        $self['child'] = $this->getChild($level->id);
        return $self;
    }

    private function allLevel()
    {
        $nickname = config('watchdog.account.name');
        foreach (AccountLevel::with('account')->where('is_active', 1)->orderBy('sort')->get() as $level) {
            $account = $level->account;
            $id = $level->id;
            $parent_id = $level->parent_id;
            $item = [
                'id' => $id,
                'code' => $level->code,
                'label' => $level->label,
                'account' => [
                    'id' => $account->id,
                    'name' => $account->$nickname
                ],
                'parent_id' => $parent_id
            ];
            $this->levels[$id] = $item;
            $this->tree[$parent_id][] = $item;
        }
    }

    private function buildTree($p_id)
    {
        $tree = [];
        foreach ($this->tree[$p_id] as $item) {
            $item['child'] = isset($this->tree[$item['id']]) ? $this->buildTree($item['id']) : null;
            $tree[] = $item;
        }
        return $tree;
    }

    protected function getParent($level_id)
    {
        $parent_id = $this->levels[$level_id]['parent_id'];
        $parent = $parent_id == 0 ? null : $this->getParent($parent_id);
        return array_merge($this->levels[$level_id], ['parent' => $parent]);
    }

    protected function getChild($level_id)
    {
        $child = [];
        foreach ($this->levels as $id => $level) {
            if ($level['parent_id'] == $level_id) {
                $level['child'] = $this->getChild($id);
                $child[] = $level;
            }
        }
        return empty($child) ? null : $child;
    }

    protected function searchTree($tree, $search)
    {
        foreach ($tree as $item) {
            if ($item['id'] == $search) return $item;
            if (!is_null($item['child'])) {
                $val = $this->searchTree($item['child'], $search);
                if (!is_null($val)) return $val;
            }
        }
        return null;
    }
}