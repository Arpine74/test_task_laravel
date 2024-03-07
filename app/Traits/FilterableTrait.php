<?php

namespace App\Traits;

trait FilterableTrait
{
    public function scopeFilter($query, $filters)
    {
        foreach ($filters as $key => $value) {
            $this->applyFilter($query, $key, $value);
        }

        return $query;
    }

    private function camelCaseToDotNotation($input)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1.$2', $input));
    }

    protected function applyFilter($query, $key, $value)
    {
        $key = $this->camelCaseToDotNotation($key);
        if (strpos($key, '.') !== false) {
            [$relation, $nestedKey] = explode('.', $key, 2);
            $query->whereHas($relation, function ($query) use ($nestedKey, $value) {
                $this->applyFilter($query, $nestedKey, $value);
            });
        } else {
            $query->where($key, $value);
        }
    }
}