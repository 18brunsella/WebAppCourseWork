<?php


namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->addLink("login.php", "Log in");
        $this->setTitle("Felis Investigations");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    public function testimonials(){
        $html = <<<HTML
<h2>TESTIMONIALS</h2>
HTML;

        if(count($this->testimonials) > 0) {
            $half = array_chunk($this->testimonials, ceil(count($this->testimonials)/2));

            $html .= "<div class='left'>";
            foreach($half[0] as $lefttestimonial){
                $html .= "<blockquote><p>";
                $html .= $lefttestimonial['statement'];
                $html .= "</p><cite>";
                $html .= $lefttestimonial['from'];
                $html .= "</cite></blockquote>";
            }

            $html .= "</div><div class='right'>";
            foreach($half[1] as $righttestimonial){
                $html .= "<blockquote><p>";
                $html .= $righttestimonial['statement'];
                $html .= "</p><cite>";
                $html .= $righttestimonial['from'];
                $html .= "</cite></blockquote>";
            }
            $html .= "</div>";
        }
        return $html;
    }

    public function addTestimonial($text, $cite){
        $this->testimonials[] = ['statement' => $text, 'from' => $cite];
    }

    private $testimonials = [];
}