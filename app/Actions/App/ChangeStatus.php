<?php

namespace App\Actions\App;

use App\Actions\App\Api\UpdateFirestore;
use Illuminate\Database\Eloquent\Model;

class ChangeStatus
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function update()
    {
        if (request('update') === 'status') {
            $this->status();
        } else if (request('update') === 'available') {
            $this->available();
        } else {
            $this->approve();
        }
    }

    protected function status()
    {
        $this->action('status');
    }

    protected function approve()
    {
        $this->action('approve');
    }

    protected function available()
    {
        $this->action('available');
    }

    protected function action($column)
    {
        $value = null;
        $update = $this->model::findOrFail(request('id'));

        if (request('update') === 'status') {
            $value = (int)$update->getAttributes()[$column] === 1 ? 0 : 1;
        } elseif (request('update') === 'available') {
            $trip = $update->trips()->orderBy('created_at', 'desc')->first();
            if ($update->available == 0 && $trip->status === 2) {
                $value = (int)$update->getAttributes()[$column] === 1 ? 0 : 1;
            } else {
                $value = (int)$update->getAttributes()[$column];
            }

        } else {
            $value = (int)$update->getAttributes()[$column] === 1 ? 2 : 1;
        }
        $update->update([$column => $value]);
        // if (request('is_driver')) {
        //     $this->updateFirestore->update('drivers', request('id'), [
        //         ['path' => $column, 'value' => $value]
        //     ]);
        // }
    }
}
