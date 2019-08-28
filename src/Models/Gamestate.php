<?php declare(strict_types=1);

namespace Bot\Models;

class Gamestate
{
    /** @var Planet[] */
    private $planets;
    /** @var Settings */
    private $settings;
    /** @var Ship[] */
    private $ships;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return Planet[]
     */
    public function getPlanets(): array
    {
        return $this->planets;
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }

    /**
     * @return Ship[]
     */
    public function getShips(): array
    {
        return $this->ships;
    }

    /**
     * @param Planet[] $planets
     */
    public function setPlanets(array $planets): void
    {
        $this->planets = $planets;
    }

    /**
     * @param Ship[] $ships
     */
    public function setShips(array $ships): void
    {
        $this->ships = $ships;
    }
}
