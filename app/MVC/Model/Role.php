<?php

namespace emptyProjectSilex\Model;

/**
 * Role
 *
 * Represents the role a user holds.
 *
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    26.01.16  -  15:37
 * @version 1.0
 */
class Role
{

    /**
     * @var $id     int     Id of the role
     */
    protected $id;
    /**
     * @var $name   string  Name of the user role
     */
    protected $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
