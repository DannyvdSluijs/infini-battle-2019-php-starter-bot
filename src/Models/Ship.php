<?php declare(strict_types=1);

namespace Bot\Models;

class Ship
{
    /** @var float */
    private $x;
    /** @var float */
    private $y;
    /** @var int */
    private $targetId;
    /** @var int|null */
    private $owner;
    /** @var float */
    private $power;

    public function __construct(float $x, float $y, int $targetId, ?int $owner, float $power)
    {
        $this->x = $x;
        $this->y = $y;
        $this->targetId = $targetId;
        $this->owner = $owner;
        $this->power = $power;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getTargetId(): int
    {
        return $this->targetId;
    }

    public function getOwner(): ?int
    {
        return $this->owner;
    }

    public function getPower(): float
    {
        return $this->power;
    }
}
