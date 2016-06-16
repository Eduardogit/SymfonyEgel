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
    

    /**
     * @var float
     */
    private $calificacionParcial;


    /**
     * Set calificacionParcial
     *
     * @param float $calificacionParcial
     * @return SubArea
     */
    public function setCalificacionParcial($calificacionParcial)
    {
        $this->calificacionParcial = $calificacionParcial;

        return $this;
    }

    /**
     * Get calificacionParcial
     *
     * @return float 
     */
    public function getCalificacionParcial()
    {
        return $this->calificacionParcial;
    }
    /**
     * @var \AreasBundle\Entity\Perfil
     */
    private $peril;


    /**
     * Set peril
     *
     * @param \AreasBundle\Entity\Perfil $peril
     * @return SubArea
     */
    public function setPeril(\AreasBundle\Entity\Perfil $peril = null)
    {
        $this->peril = $peril;

        return $this;
    }

    /**
     * Get peril
     *
     * @return \AreasBundle\Entity\Perfil 
     */
    public function getPeril()
    {
        return $this->peril;
    }
    /**
     * @var \AreasBundle\Entity\Perfil
     */
    private $perfil;


    /**
     * Set perfil
     *
     * @param \AreasBundle\Entity\Perfil $perfil
     * @return SubArea
     */
    public function setPerfil(\AreasBundle\Entity\Perfil $perfil = null)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return \AreasBundle\Entity\Perfil 
     */
    public function getPerfil()
    {
        return $this->perfil;
    }
}
