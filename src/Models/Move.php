<?php declare(strict_types=1);

namespace Bot\Models;

class Move
{
    private $power;
    private $source;
    private $target;

    public function __construct($power, $source, $target)
    {
        $this->power = $power;
        $this->source = $source;
        $this->target = $target;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function __toString(): string
    {
        return "send-ship {$this->power} {$this->source} {$this->target}";
    }
}
