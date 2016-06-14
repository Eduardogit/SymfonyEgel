<?php

namespace AreasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubArea
 */
class SubArea
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    //protected $Area;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SubArea
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }


    /**
     * Set Area
     *
     * @param int $Area
     * @return SubArea
     */
    public function setArea($Area)
    {
        $this->Area = $Area;

        return $this;
    }

    /**
     * Get Area
     *
     * @return int 
     */
    public function getArea()
    {
        return $this->Area;
    }
    /**
     * @var \AreasBundle\Entity\Area
     */
    private $Area;

    public function __toString()
    {
        return (string) $this->getArea();
    }


}
