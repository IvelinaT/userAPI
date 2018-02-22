<?php
namespace User\Repository;

use User\Model\User;


class UserRepository {
    /**
     * @return array User[]
     */
    public function getAllUsers(){
        return User::orderBy('id')->get();
    }


    /**
     * @param int $id
     *
     * @return int
     */
    public function deleteUser($id){
        return User::destroy($id);
    }

    /**
     * @param int $id
     *
     * @return null|User
     */
    public function getUser($id){
        return User::find($id);
    }

    /**
     * @param int $id
     *
     * @return null|User
     */
    public function updateUser($id,$data){
       $user = $this->getUser($id);
        if($user){
            $user->update($data);
        }
        return $user;
    }


}