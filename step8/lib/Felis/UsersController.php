<?php

namespace Felis;

/**
 * Controller for the users page users.php
 * Utilized by post/users.php
 */
class UsersController {
    /**
     * UsersController constructor.
     * @param Site $site Site object
     * @param User $user Current user
     * @param array $post $_POST
     */
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/users.php";
        if(isset($post['add'])){
            $this->redirect = "$root/user.php";
        }else if(isset($post['edit']) && isset($post['user'])){
            $userid = $post['user'];
            $this->redirect = "$root/user.php?id=$userid";
        }else if(isset($post['delete']) && isset($post['user'])){
            $users = new Users($site);
            $users->delete($post['user']);
        }
    }

    /**
     * Get any redirect link
     * @return mixed Redirect link
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}