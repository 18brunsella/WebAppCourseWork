<?php


namespace Felis;


class PasswordValidateView extends View
{
    const EMAIL_DOES_NOT_MATCH = 1;
    const INVALID_VALIDATOR = 2;
    const INVALID_USER = 3;
    const PASSWORDS_DONT_MATCH = 4;
    const PASSWORD_TOO_SHORT = 5;

    public function __construct(Site $site, array $get){
        $this->setTitle("Felis Password Entry");
        if(isset($get['v'])) {
            $this->validator = strip_tags($get['v']);
        }

        if(isset($get['e'])){
            $this->errortype = strip_tags($get['e']);
        }
    }

    public function present(){
        $html = <<<HTML
<form method="post" action="post/password-validate.php">
        <input type="hidden" name="validator" value="$this->validator">    
        <fieldset>
            <legend>Change Password</legend>
            <p>
                <label for="email">Email</label>
                <br>
                <input type="text" id="email" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password:</label>
                <br>
                <input type="text" id="password" name="password" placeholder="password">
            </p>
            <p>
                <label for="passwordone">Password (again):</label>
                <br>
                <input type="text" id="password2" name="password2" placeholder="password">
            </p>
HTML;
        if($this->errortype == self::EMAIL_DOES_NOT_MATCH){
            $html .= "<p>Email does not match</p>";
        } else if($this->errortype == self::INVALID_VALIDATOR){
            $html .= "<p>Validator is invalid</p>";
        } else if($this->errortype == self::INVALID_USER){
            $html .= "<p>Email is invalid</p>";
        } else if($this->errortype == self::PASSWORDS_DONT_MATCH){
            $html .= "<p>Passwords do not match</p>";
        } else if($this->errortype == self::PASSWORD_TOO_SHORT){
            $html .= "<p>Password too short</p>";
        }

        $html .= <<<HTML
            <p>
                <input type="submit" name="ok" id="ok" value="OK">
                <input type="submit" name="cancel" name="cancel" value="Cancel">
            </p>
        </fieldset>
    </form>
HTML;

        return $html;
    }

    private $validator;
    private $errortype;
}