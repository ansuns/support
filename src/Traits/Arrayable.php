<?php

declare(strict_types=1);

namespace Ansuns\Supports\Traits;

use ReflectionClass;
use Ansuns\Supports\Str;

trait Arrayable
{
    /**
     * toArray.
     *
     * @author ansuns
     *
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $result = [];

        foreach ((new ReflectionClass($this))->getProperties() as $item) {
            $k = $item->getName();
            $method = 'get'.Str::studly($k);

            $result[Str::snake($k)] = method_exists($this, $method) ? $this->{$method}() : $this->{$k};
        }

        return $result;
    }
}
