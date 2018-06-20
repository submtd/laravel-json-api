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
        // grab includes
        foreach ($this->getRelations() as $relation) {
            $return['included'] = array_merge((array) $return['included'], $relation->toArray());
        }
        // format dates properly
        foreach ($this->getDates() as $dateField) {
            if (isset($return['attributes'][$dateField])) {
                $return['attributes'][$dateField] = $this->$dateField->toIso8601String();
            }
        }
        return $return;
    }
}
