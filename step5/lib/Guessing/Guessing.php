<?php


namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;

    const INVALID = -1;
    const TOOLOW = -2;
    const CORRECT = -3;
    const TOOHIGH = -4;
    const NONE = -5;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getNumGuesses()
    {
        return $this->num_guesses;
    }

    public function getGuess()
    {
        return $this->user_guess;
    }

    public function guess($num)
    {
        $this->user_guess = $num;

        if(is_numeric($num) && ($num <= self::MAX && $num >= self::MIN)){
            $this->num_guesses++;
        }
    }

    public function check()
    {
        $guess = $this->getGuess();

        if($guess == self::NONE && is_numeric($guess)){
            return self::NONE;
        }

        if ($guess < self::MIN || $guess > self::MAX || !is_numeric($guess)) {
            return self::INVALID;
        }else if($guess < $this->number){
            return self::TOOLOW;
        }else if($guess == $this->number){
            return self::CORRECT;
        }else if($guess > $this->number){
            return self::TOOHIGH;
        }
    }

    private $num_guesses = 0;
    private $number;
    private $user_guess = self::NONE;
}