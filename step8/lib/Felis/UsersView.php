<?php

namespace Felis;

/**
 * View class for the users page users.php
 */
class UsersView extends View {
    /**
     * Constructor
     * Sets the page title and any other settings.
     * @param Site $site The Site object
     */
    public function __construct(Site $site) {
        $this->site = $site;

        $this->setTitle("Felis Investigations Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log out");
    }

    /**
     * Present the users form
     * @return string HTML
     */
    public function present() {
        $html = <<<HTML
<form class="table" method="post" action="post/users.php">
    <p>
    <input type="submit" name="add" id="add" value="Add">
    <input type="submit" name="edit" id="edit" value="Edit">
    <input type="submit" name="delete" id="delete" value="Delete">
    </p>

    <table>
        <tr>
            <th>&nbsp;</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
HTML;
        $users = new Users($this->site);
        $userArray = $users->getUsers();
        foreach($userArray as $user) {
            $id = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $role = $user->getRole();
            $html .= <<<HTML
        <tr>
            <td><input type="radio" name="user" value="$id"></td>
            <td>$name</td>
            <td>$email</td>
            <td>$role</td>
        </tr>
HTML;
        }
        $html .= <<<HTML
    </table>
</form>
HTML;

        return $html;
    }

    private $site;
}