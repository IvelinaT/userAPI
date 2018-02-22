<?php

namespace User\Validation\Rules;

use User\Model\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{

    public function validate($input)
    {
        return ! User::where('email', $input)->exists();
    }
}