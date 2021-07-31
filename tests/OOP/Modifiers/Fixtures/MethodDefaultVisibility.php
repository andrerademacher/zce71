<?php

declare(strict_types=1);

namespace Zce71\OOP\Modifiers\Fixtures;

/**
 * A class method's visibility is public by default in case no access modifier is given.
 */
class MethodDefaultVisibility
{
    function myMethod(): int
    {
        return 2;
    }
}
