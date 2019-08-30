<?php declare(strict_types=1);

namespace Bot;

use Bot\Models\Gamestate;
use Bot\Models\Planet;
use Bot\Models\Settings;
use Bot\Models\Ship;

class Bot
{
    public static function start(Strategy $strategy): void
    {
        $settings = new Settings(
            self::readInt('seed'),
            self::readInt('num-players'),
            self::readInt('player-id'),
        );

        $line = '';
        while (($line = readline()) !== 'game-end') {
            $gameState = new Gamestate($settings);

            if ($line !== 'turn-init') {
                throw new \Exception("Expected 'turn-init', got '{$line}'");
            }

            $gameState->setPlanets(self::readPlanets());
            $gameState->setShips(self::readShips());

            $line = readline();
            if ($line !== 'turn-start') {
                throw new \Exception("Expected 'turn-start', got '{$line}");
            }

            foreach ($strategy($gameState) as $move) {
                fwrite(STDOUT, (string) $move . PHP_EOL);
            }

            fwrite(STDOUT, 'end-turn' . PHP_EOL);
        }
    }

    private static function readInt(string $key): int
    {
        return (int) self::readValue($key);
    }

    private static function readValue(string $key): string
    {
        $line = readline();
        $parts = explode(' ', $line);

        if (count($parts) !== 2 || $parts[0] !== $key) {
            throw new \Exception("Excepted '{$key} <value>', got '{$line}'");
        }

        return $parts[1];
    }

    private static function readPlanets(): array
    {
        $planetCount = self::readInt('num-planets');
        $planets = [];

        for ($x = 0; $x < $planetCount; $x++) {
            $planet = self::readPlanet();
            $planets[$planet->getId()] = $planet;
        }

        return $planets;
    }

    private static function readPlanet(): Planet
    {
        $line = readline();
        $parts = explode(' ', $line);

        if (count($parts) !== 7 || $parts[0] !== 'planet') {
            throw new \Exception("Expected 'planet <id> <x> <y> <radius> <owner> <health>', got '{$line}'");
        }

        return new Planet(
            (int) $parts[1],
            (float) $parts[2],
            (float) $parts[3],
            (float) $parts[4],
            self::parseOwner($parts[5]),
            (float) $parts[6],
            self::readNeighbours()
        );
    }

    private static function parseOwner(string $owner): ?int
    {
        if ($owner === 'neutral') {
            return null;
        }

        return (int) $owner;
    }

    private static function readNeighbours(): array
    {
        $line = readline();
        $parts = explode(' ', $line);

        if (count($parts) === 0 || $parts[0] !== 'neighbors') {
            throw new \Exception("Expected 'neighbors <neighbor1> <neighbor2> ...', got '{$line}'");
        }

        array_shift($parts);
        return array_map('intval', $parts);
    }

    private static function readShips()
    {
        $shipCount = self::readInt('num-ships');
        $ships = [];

        for ($x = 0; $x < $shipCount; $x++) {
            $ships[] = self::readShip();
        }

        return $ships;
    }

    private static function readShip()
    {
        $line = readline();
        $parts = explode(' ', $line);

        if (count($parts) !== 6 || $parts[0] !== 'ship') {
            throw new \Exception("Expected 'ship <x> <y> <target_id> <owner> <power>', got '{$line}'");
        }

        return new Ship(
            (float) $parts[1],
            (float) $parts[2],
            (int) $parts[3],
            self::parseOwner($parts[4]),
            (float) $parts[5],
        );
    }
}
