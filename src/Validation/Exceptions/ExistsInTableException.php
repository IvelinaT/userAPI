<?php

namespace User\Validation\Exceptions;

use \Respect\Validation\Exceptions\ValidationException;

class ExistsInTableException extends ValidationException
{

    public static $defaultTemplates = [

        self::MODE_NEGATIVE  => [
            self::STANDARD => 'has already been applied',
        ],
        self::MODE_DEFAULT  => [
            self::STANDARD => 'Id does not exist',
        ],
    ];
}
