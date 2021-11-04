<?php

namespace App\Models;

use Exception;

trait Editable
{
    public function editIf($data = [], callable $predicate) 
    {
        $edits = [];

        foreach ($data as $key => $value) {
            $edits[] = $predicate($key, $this->getAttribute($key), $value);
            if (end($edits)) {
                $this->setAttribute($key, $value);;
            }
        }

        return $edits;
    }

    public function edit($data = [])
    {
        $always = $this->editable ?? [];
        $once = $this->editableOnce ?? [];

        return $this->editIf($data, function ($key, $value, $new_value) use ($always, $once) {
            return in_array($key, $always) || (in_array($key, $once) && $value == null);
        });
    }

    public function editOrFail($data = [])
    {
        $all = function (array $array) {
            foreach ($array as $value) {
                if (!$value) {
                    return false;
                }
            }
            return true;
        };

        $edits = $this->edit($data);
        $keys = array_keys($data);

        if (!$all($edits)) {
            for ($i = 0; $i < count($data); $i++) {
                if (!$edits[$i]) {
                    continue;
                }

                $key = $keys[$i];
                $value = $this->getOriginal($key);
                $this->setAttribute($key, $value);
            }

            throw new Exception();
        }

        return $edits;
    }
}