<?php

namespace App\Exceptions;

use RuntimeException;

class ReadOnlyModelException extends RuntimeException
{
    /**
     * Name of the affected Eloquent model.
     *
     * @var string
     */
    protected $model;

    /**
     * Set the affected Eloquent model.
     *
     * @param  string  $model
     * @return $this
     */
    public function setModel($model)
    {
        $this -> model = $model;
        $this -> message = "Not allowed to persist changes in read-only model [{$model}].";

        return $this;
    }
    /**
     * Get the affected Eloquent model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this -> model;
    }

}