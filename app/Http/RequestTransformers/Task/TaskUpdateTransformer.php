<?php

namespace App\Http\RequestTransformers\Task;

use App\Http\RequestTransformers\AbstractRequestTransformer;

class TaskUpdateTransformer extends AbstractRequestTransformer
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'title' => 'title',
            'description' => 'description',
            'status' => 'status',
        ];
    }
}
