<?php


namespace Felis;


class DeleteCaseView extends View
{
    public function __construct(Site $site, array $get){
        $this->site = $site;
        $this->get = $get;
        $this->setTitle("Felis Delete?");
        $this->addLink("staff.php","Staff");
        $this->addLink("cases.php","Cases");
        $this->addLink("post/logout.php","Log Out");
    }

    public function present(){
        $id = $this->get['id'];
        $cases = new Cases($this->site);
        $case = $cases->get($id);
        $number = $case->getNumber();

        $html = <<<HTML
<form method="post" action="post/deletecase.php">
	<fieldset>
	    <input type="hidden" name="id" value="$id" >
		<legend>Delete?</legend>
		<p>Are you sure absolutely certain beyond a shadow of
			a doubt that you want to delete case $number?</p>

		<p>Speak now or forever hold your peace.</p>

		<p><input type="submit" name="yes" value="Yes"> <input type="submit" name="no" value="No"></p>

	</fieldset>
</form>
HTML;
        return $html;
    }

    private $site;	///< The Site object
    private $get;
}