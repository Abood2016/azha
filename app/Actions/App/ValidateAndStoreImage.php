<?php

namespace App\Actions\App;

class ValidateAndStoreImage
{
    public function store(string $input, string $folder, ?array $rules = [])
    {
        if (request()->hasFile($input)) {
            return [
                array_keys($this->validate($input, $rules))[0] =>
                $this->validate($input, $rules)[$input] = request()->file($input)->store($folder)
            ];
        }

        return [];
    }

    protected function validate(string $input, ?array $rules = [])
    {
        return request()->validate([
            $input => array_merge(['file'], $rules)
        ]);
    }
}
