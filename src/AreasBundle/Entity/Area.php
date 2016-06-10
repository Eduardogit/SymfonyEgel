<?php

namespace AreasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Area
 */
class Area
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;


//    protected $subarea;
//    public function __construct()
//    {
//        $this->subarea = new ArrayCollection;
//    }
//    public function setSubArea($subarea)
//    {
//        $this->subarea = $subarea;
//        return $this;
//    }
//    public function getSubarea()
//    {
//        return $this->subarea;
//    }



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
     * @return Area
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
     * Add subarea
     *
     * @param \AreasBundle\Entity\SubArea $subarea
     * @return Area
     */
    public function addSubarea(\AreasBundle\Entity\SubArea $subarea)
    {
        $this->subarea[] = $subarea;

        return $this;
    }

    /**
     * Remove subarea
     *
     * @param \AreasBundle\Entity\SubArea $subarea
     */
    public function removeSubarea(\AreasBundle\Entity\SubArea $subarea)
    {
        $this->subarea->removeElement($subarea);
    }
}
