<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent] final class Game extends AbstractController
{
    use DefaultActionTrait;

    #[LiveProp] public bool $running = false;

    #[LiveProp] public array $asteroids = [];

    #[LiveProp] public int $spaceShip = 5;

    #[LiveProp] public bool $gameOver = false;

    #[LiveProp] public int $score = 0;


    #[LiveAction] public function addAsteroid()
    {
        if (isset($this->asteroids[9]) && $this->asteroids[9] == $this->spaceShip) {
            $this->gameOver = true;
            $this->running = false;
        } else {
            array_unshift($this->asteroids, rand(0, 9));
            $this->score++;

            if (count($this->asteroids) > 10) {
                array_pop($this->asteroids);
            }
        }
    }

    #[LiveAction] public function toggleRunning()
    {
        $this->running = !$this->running;
    }

    #[LiveAction] public function moveLeft()
    {
        if ($this->spaceShip > 0 && $this->running) {

            $this->spaceShip--;
        }
    }

    #[LiveAction] public function moveRight()
    {
        if ($this->spaceShip < 9 && $this->running) {

            $this->spaceShip++;
        }
    }
}
