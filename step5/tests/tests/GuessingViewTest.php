<?php

use Guessing\Guessing as Guessing;
use Guessing\GuessingView as GuessingView;

class GuessingViewTest extends \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct() {
        $guessing = new Guessing(self::SEED);
        $view = new GuessingView($guessing);
        $this->assertNotEquals(null,$view);
    }

    public function test_allScenarios()
    {
        // Start of a new game
        $guessing = new Guessing(self::SEED);
        $view = new GuessingView($guessing);
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('Try to guess the number.', $view->present());

        // too low
        $guessing->guess(1);
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('too low', $view->present());
        $guessing->guess(15);
        $this->assertContains('After 2 guesses you are too low!', $view->present());
        $this->assertContains('Guessing Game', $view->present());

        // too high
        $guessing->guess(100);
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('too high', $view->present());
        $guessing->guess(50);
        $this->assertContains('After 4 guesses you are too high!', $view->present());
        $this->assertContains('Guessing Game', $view->present());

        // invalid
        $guessing->guess(-100);
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('Your guess of -100 is invalid!', $view->present());
        $guessing->guess('a');
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('Your guess of a is invalid!', $view->present());

        // guess right after invalid to see if not incremented after invalid guess
        $guessing->guess(34);
        $this->assertContains('After 5 guesses you are too high!', $view->present());
        $this->assertContains('Guessing Game', $view->present());

        // correct guess
        $guessing->guess(23);
        $this->assertContains('Guessing Game', $view->present());
        $this->assertContains('After 6 guesses you are correct!', $view->present());
    }
}