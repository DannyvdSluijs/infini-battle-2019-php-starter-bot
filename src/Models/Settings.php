<?php declare(strict_types=1);

namespace Bot\Models;

class Settings
{
    /** @var int */
    private $seed;
    /** @var int */
    private $players;
    /** @var int */
    private $playerId;

    public function __construct(int $seed, int $players, int $playerId)
    {
        $this->seed = $seed;
        $this->players = $players;
        $this->playerId = $playerId;
    }

    public function getSeed(): int
    {
        return $this->seed;
    }

    public function getPlayers(): int
    {
        return $this->players;
    }

    public function getPlayerId(): int
    {
        return $this->playerId;
    }
}
