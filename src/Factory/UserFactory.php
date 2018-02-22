<?php

namespace User\Factory;

use User\Model\User;

/**
 * Class UserFactory.
 */
class UserFactory
{

    /**
     * @param array $data
     *
     * @return bool|\User\Model\User
     */
    public function createNewUser($data)
    {

        $user = new User();
        $user->forename  = $data['forename'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->save();
        return $user;
    }

    /**
     * @param array $data
     * @param array \User\Model\User
     *
     * @return bool|\User\Model\User
     */
    public function updateUser(User $user,$data)    {

        $user->forename  = $data['forename']?:$user->forename;
        $user->surname = $data['surname']?:$user->surname;
        $user->email = $data['email']?:$user->email;
        $user->save();
        return $user;
    }
}