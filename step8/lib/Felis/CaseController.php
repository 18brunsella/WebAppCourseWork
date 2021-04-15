<?php


namespace Felis;


class CaseController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();
        $cases = new Cases($site);
        if(isset($post['update'])) {
            $id = strip_tags($post['id']);
            $case = $cases->get($id);
            $number = strip_tags($post['number']);
            $summary = strip_tags($post['summary']);
            $agent = strip_tags($post['agent']);
            $status = strip_tags($post['status']);

            $cases = new Cases($site);
            $cases->update($id, $number, $summary, $agent, $status);

        }
        $this->redirect = "$root/cases.php";

    }

    public function getRedirect(){
        return $this->redirect;
    }

    private $redirect;	// Page we will redirect the user to.
}