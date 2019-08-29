<?php declare(strict_types=1);

namespace Bot\Models;

class Planet
{
    /** @var int */
    private $id;
    /** @var float */
    private $x;
    /** @var float */
    private $y;
    /** @var float */
    private $radius;
    /** @var int|null */
    private $owner;
    /** @var float */
    private $health;
    /** @var int[] */
    private $neighbours;

    public function __construct(
        int $id,
        float $x,
        float $y,
        float $radius,
        ?int $owner,
        float $health,
        array $neighbours
    ) {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
        $this->owner = $owner;
        $this->health = $health;
        $this->neighbours = $neighbours;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function getOwner(): ?int
    {
        return $this->owner;
    }

    public function getHealth(): float
    {
        return $this->health;
    }

    public function getNeighbours(): array
    {
        return $this->neighbours;
    }

    public function distanceTo(Planet $other): float
    {
        $dx = $other->getX() - $this->x;
        $dy = $other->getY() - $this->y;

        return sqrt($dx * $dx - $dy * $dy);
    }
}
