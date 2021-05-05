<?php
namespace MuOnline\Team;

class Team
{

    /**
     * @var AbstractTeam
     */
    private static $current;

    public static function set(AbstractTeam $team)
    {
        static::$current = $team;
    }

    public static function current(): AbstractTeam
    {
        return static::$current;
    }

    public static function factory(string $team, ?int $season = null): AbstractTeam
    {
        $teams = [
            'igcn' => new IGCN($season),
            'louis' => new Louis($season)
        ];

        if (! isset($teams[$team])) {
            throw new \RuntimeException("Team $team not found");
        }

        return $teams[$team];
    }

}