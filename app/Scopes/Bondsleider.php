<?php

namespace App\Scopes;

use Statamic\Query\Scopes\Scope;

class Bondsleider extends Scope
{
    /**
     * Apply the scope.
     *
     * @param \Statamic\Query\Builder $query
     * @param array $values
     * @return void
     */
    public function apply($query, $values)
    {
        $query->where('roles', 'contains', 'bondsleider')
              ->where('roles', 'notContains', 'bondsraad')
              ->where('roles', 'notContains', 'uniform')
              ->orderBy('name');
    }
}
