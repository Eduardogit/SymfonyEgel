<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 */
class Test
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $fechaFin;

    /**
     * @var string
     */
    private $estatus;

    /**
     * @var \testBundle\Entity\AreasCompletadas
     */
    private $areasCompletadas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Test
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Test
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set estatus
     *
     * @param string $estatus
     * @return Test
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string 
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set areasCompletadas
     *
     * @param \testBundle\Entity\AreasCompletadas $areasCompletadas
     * @return Test
     */
    public function setAreasCompletadas(\testBundle\Entity\AreasCompletadas $areasCompletadas = null)
    {
        $this->areasCompletadas = $areasCompletadas;

        return $this;
    }

    /**
     * Get areasCompletadas
     *
     * @return \testBundle\Entity\AreasCompletadas 
     */
    public function getAreasCompletadas()
    {
        return $this->areasCompletadas;
    }

    /**
     * Add usuario
     *
     * @param \UsuarioBundle\Entity\Usuario $usuario
     * @return Test
     */
    public function addUsuario(\UsuarioBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \UsuarioBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\UsuarioBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setUsuario(\UsuarioBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
    /**
     * @var integer
     */
    private $calificacion;


    /**
     * Set calificacion
     *
     * @param integer $calificacion
     * @return Test
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }
}
