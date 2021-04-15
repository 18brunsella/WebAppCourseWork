<?php


namespace Felis;


class DeleteCaseController
{
    public function __construct(Site $site, User $user, array $post){
        $root = $site->getRoot();

        if(isset($post['yes'])){
            $id = $post['id'];
            $cases = new Cases($site);
            $cases->delete($id);
            $this->redirect = "$root/cases.php";
        }else{
            $this->redirect = "$root/cases.php";
        }

    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;	// Page we will redirect the user to.
}