<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait CanSaveWithoutUpdatedAt
{
    /**
     * Save the model without updating the updated_at value
     */
    public function saveWithoutUpdatedAt(): bool
    {
        assert($this instanceof Model);

        $this->timestamps = false;
        $returnVal = $this->save();
        $this->timestamps = true;
        return $returnVal;
    }
}
