<?php declare(strict_types=1);

namespace Bot;

use Bot\Models\Gamestate;
use Bot\Models\Move;
use Bot\Models\Planet;

class Strategy
{
    /**
     * @return array|Move[]
     */
    public function __invoke(Gamestate $gameState): array
    {
        $moves = [];

        /** @var Planet[] $myPlanets */
        $myPlanets = array_filter(
            $gameState->getPlanets(),
            static function (Planet $p) use ($gameState) {
                return $p->getOwner() === $gameState->getSettings()->getPlayerId()
                    && $p->getHealth() >= random_int(2, 100);
            }
        );

        foreach ($myPlanets as $planet) {
            $targets = array_map(
                static function (int $neighbour) use ($gameState) {
                    return $gameState->getPlanets()[$neighbour];
                },
                $planet->getNeighbours()
            );
            $targets = array_filter(
                $targets,
                static function (Planet $planet) use ($gameState) {
                    return $planet->getOwner() !== $gameState->getSettings()->getPlayerId();
                }
            );
            usort(
                $targets,
                static function (Planet $p) use ($planet) {
                    return $p->distanceTo($planet);
                }
            );

            /** @var Planet $target */
            $target = array_shift($targets);
            if ($target !== null) {
                $power = $gameState->getPlanets()[$planet->getId()]->getHealth() / 2;
                $moves[] = new Move($power, $planet->getId(), $target->getId());
            }
        }

        return $moves;
    }
}
