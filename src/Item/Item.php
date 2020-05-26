<?php
namespace MuOnline\Item;

use MuOnline\Item\Sockets\Slot as SocketSlot;
use MuOnline\Item\Excellent\Slot as ExcellentSlot;

/**
 * Class Item
 * @package MuOnline\Item
 */
class Item
{

    /**
     * @var int
     */
    private $section;

    /**
     * @var int
     */
    private $index;

    /**
     * @var int
     */
    private $level = 0;

    /**
     * @var
     */
    private $option = 0;

    /**
     * @var Luck
     */
    private $luck;

    /**
     * @var Skill
     */
    private $skill;

    /**
     * @var Durability
     */
    private $durability;

    /**
     * @var Excellent
     */
    private $excellent;

    /**
     * @var Serial
     */
    private $serial;

    /**
     * @var Ancient
     */
    private $ancient;

    /**
     * @var bool
     */
    private $refine = false;

    /**
     * @var Harmony
     */
    private $harmony;

    /**
     * @var Sockets
     */
    private $sockets;


    public function __construct(int $section = null, int $index = null)
    {
        $this->section = $section;
        $this->index = $index;
    }

    /**
     * @param int $section
     * @return $this
     */
    public function setSection(int $section) : self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSection() : ?int
    {
        return $this->section;
    }

    /**
     * @param int $index
     * @return $this
     */
    public function setIndex(int $index) : self
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIndex() : ?int
    {
        return $this->index;
    }

    /**
     * @param int $level
     * @return $this
     */
    public function setLevel(int $level) : self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel() : int
    {
        return $this->level;
    }

    /**
     * @param int $levels
     * @return $this
     */
    public function addLevel(int $levels = 1) : self
    {
        $this->level += $levels;

        return $this;
    }

    /**
     * @param int $option
     * @return $this
     */
    public function setOption(int $option) : self
    {
        $this->option = $option;

        return $this;
    }

    /**
     * @return int
     */
    public function getOption() : int
    {
        return $this->option;
    }

    /**
     * @param int $options
     * @return int
     */
    public function addOption(int $options = 4) : self
    {
        $this->option += $options;

        return $this;
    }

    /**
     * @param Luck $luck
     * @return $this
     */
    public function setLuck(Luck $luck) : self
    {
        $this->luck = $luck->setItem($this);

        return $this;
    }

    /**
     * @return Luck
     */
    public function getLuck() : Luck
    {
        return $this->luck;
    }

    /**
     * @return $this
     */
    public function addLuck() : self
    {
        if (! $this->luck) {
            $this->luck = (new Luck())->setItem($this);
        }

        $this->luck->add();

        return $this;
    }

    /**
     * @param $skill
     * @return $this
     */
    public function setSkill(Skill $skill) : self
    {
        $this->skill = $skill->setItem($this);

        return $this;
    }

    /**
     * @return Skill
     */
    public function getSkill() : Skill
    {
        return $this->skill;
    }

    /**
     * @return $this
     */
    public function addSkill() : self
    {
        if (! $this->skill) {
            $this->skill = (new Skill())->setItem($this);
        }

        $this->skill->add();

        return $this;
    }

    /**
     * @param Durability|int $durability
     * @return $this
     */
    public function setDurability($durability) : self
    {
        if (! $durability instanceof Durability) {
            $durability = new Durability($durability);
        }

        $this->durability = $durability->setItem($this);

        return $this;
    }

    /**
     * @return Durability
     */
    public function getDurability() : Durability
    {
        return $this->durability;
    }

    /**
     * @param Ancient $ancient
     * @return $this
     */
    public function setAncient(Ancient $ancient) : self
    {
        $this->ancient = $ancient->setItem($this);

        return $this;
    }

    /**
     * @return Ancient
     */
    public function getAncient() : Ancient
    {
        return $this->ancient;
    }

    /**
     * @param int $type
     * @param int $stamina
     * @return $this
     */
    public function addAncient(int $type, int $stamina = Ancient::STAMINA_5) : self
    {
        if (! $this->ancient) {
            $this->ancient = (new Ancient())->setItem($this);
        }

        $this->ancient->add($type, $stamina);

        return $this;
    }

    /**
     * @param Serial $serial
     * @return $this
     */
    public function setSerial(Serial $serial) : self
    {
        $this->serial = $serial->setItem($this);

        return $this;
    }

    /**
     * @return Serial
     */
    public function getSerial() : Serial
    {
        return $this->serial;
    }

    /**
     * @return $this
     */
    public function generateSerial() : self
    {
        if (! $this->serial) {
            $this->serial = (new Serial())->setItem($this);
        }

        $this->serial->generate();

        return $this;
    }

    /**
     * @param Excellent $excellent
     * @return $this
     */
    public function setExcellent(Excellent $excellent) : self
    {
        $this->excellent = $excellent->setItem($this);

        return $this;
    }

    /**
     * @return Excellent
     */
    public function getExcellent() : Excellent
    {
        return $this->excellent;
    }

    /**
     * @param $index
     * @param $slot
     * @return $this
     */
    public function addExcellentInSlot($index, $slot) : self
    {
        if (! $this->excellent) {
            $this->excellent = (new Excellent())->setItem($this);
        }

        if (! $slot instanceof ExcellentSlot) {
            $slot = new ExcellentSlot($slot);
        }

        $this->excellent->add($index, $slot);

        return $this;
    }

    /**
     * @param Harmony $harmony
     * @return $this
     */
    public function setHarmony(Harmony $harmony) : self
    {
        $this->harmony = $harmony->setItem($this);

        return $this;
    }

    /**
     * @return Harmony
     */
    public function getHarmony() : Harmony
    {
        return $this->harmony;
    }

    /**
     * @param int $type
     * @param int $level
     * @return $this
     */
    public function addHarmony(int $type = 0, int $level = 0) : self
    {
        if (! $this->harmony) {
            $this->harmony = (new Harmony())->setItem($this);
        }

        $this->harmony->add($type, $level);

        return $this;
    }

    /**
     * @param bool $refine
     * @return $this
     */
    public function setRefine(bool $refine) : self
    {
        $this->refine = $refine;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRefine() : bool
    {
        return $this->refine;
    }

    /**
     * @return $this
     */
    public function addRefine() : self
    {
        return $this->setRefine(true);
    }

    /**
     * @param Sockets $sockets
     * @return $this
     */
    public function setSockets(Sockets $sockets) : self
    {
        $this->sockets = $sockets->setItem($this);

        return $this;
    }

    /**
     * @return Sockets
     */
    public function getSockets() : Sockets
    {
        return $this->sockets;
    }

    /**
     * @param $index
     * @param $slot
     * @return $this
     */
    public function addSocketInSlot($index, $slot) : self
    {
        if (! $this->sockets) {
            $this->sockets = (new Sockets())->setItem($this);
        }

        if (! $slot instanceof SocketSlot) {
            $slot = new SocketSlot($slot);
        }

        $this->sockets->add($index, $slot);

        return $this;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function parse(?string $hex = null) : self
    {

        return $this;
    }

    /**
     * @return string
     */
    public function make() : string
    {

        return '';
    }
}