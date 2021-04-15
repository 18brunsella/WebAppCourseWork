<?php


namespace Felis;


class CasesController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();

        if(isset($post['add'])) {
            $this->redirect = "$root/newcase.php";
        }else if(isset($post['delete']) && isset($post['user'])) {
            $id = $post['user'];
            $this->redirect = "$root/deletecase.php?id=$id";
        }else if(isset($post['edit']) && isset($post['user'])){
            $id = $post['user'];
            $this->redirect = "$root/case.php?id=$id";
        }else{
            $this->redirect = "$root/cases.php";
        }
    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;	// Page we will redirect the user to.
}