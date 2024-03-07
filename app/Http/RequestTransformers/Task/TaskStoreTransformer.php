<?php

namespace App\Http\RequestTransformers\Task;

use App\Http\RequestTransformers\AbstractRequestTransformer;

class TaskStoreTransformer extends AbstractRequestTransformer
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'title' => 'title',
            'description' => 'description',
        ];
    }
}
