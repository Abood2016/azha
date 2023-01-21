<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
trait GetIndexData
{
    use PaginationOffset, Sort;

    public function data($data, $isModel = true): JsonResource
    {

        // Request is API
        if (request()->is('api/*')) {
            return $this->api($data, $isModel);
        }
        // Metronic
        return $this->metronic($data, $isModel);
    }

    protected function pipeline($data)
    {

        return $this->sort($data);
    }

    protected function api($data, $isModel)
    {

        if ($isModel) {
            $resource = config('model_resources.' . get_class($data));
        } else {
            $resource = config('model_resources.' . get_class($data->first()));
            $data = $data->first();
        }

        return new $resource($data::paginate(request()->perpage ?? 10));
    }

    protected function metronic($data, $isModel)
    {

        if ($isModel) {
            $resource = config('model_resources.' . get_class($data));
        } else {
            $resource = config('model_resources.' . get_class($data->first()));
        }

         $this->pipeline($data)
            ->skip($this->offset($this->pipeline($data)->count()))
            ->paginate(request()->pagination['perpage'] ?? 10);

        return new $resource(
            $this->pipeline($data)
                ->skip($this->offset($this->pipeline($data)->count()))
                ->paginate(request()->pagination['perpage'] ?? 10)
            );
    }
}
