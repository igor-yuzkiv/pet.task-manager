<?php

namespace App\Core\Libraries\EloquentFilter;

/**
 * @example
 *
 * #[FiltersAttribute([
 *  'someFirstFilter'  => SomeFirst::class,
 *  'someSecondFilter' => [SomeSecond::class, ['parameter' => 'value']]
 * ])]
 */
#[\Attribute]
class FiltersAttribute
{
    public function __construct(
        array $filters = []
    ) {}
}
