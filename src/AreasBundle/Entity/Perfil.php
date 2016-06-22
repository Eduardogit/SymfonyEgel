<?php

namespace AreasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 */
class Perfil
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var float
     */
    private $calificacionParcial;


    protected $subarea;

    /**
     * Set subarea
     *
     * @param int $subarea
     * @return Perfil
     */
    public function setSubarea($subarea)
    {
        $this->subarea = $subarea;

        return $this;
    }

    /**
     * Get subarea
     *
     * @return int 
     */
    public function getSubarea()
    {
        return $this->subarea;
    }




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
     * @return Perfil
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
     * Set calificacionParcial
     *
     * @param float $calificacionParcial
     * @return Perfil
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
}
