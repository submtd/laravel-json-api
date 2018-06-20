<?php

namespace Submtd\LaravelJsonApi\Traits;

trait JsonApiable
{
    public function toArray()
    {
        $return = [
            'type' => $this->type ?? $this->getTable(),
            'id' => (string)$this->getKey(),
            'attributes' => $this->attributesToArray(),
        ];
        foreach ($this->getRelations() as $relation) {
            $return['included'] = array_merge((array) $return['included'], $relation->toArray());
        }
        return $return;
    }
}
