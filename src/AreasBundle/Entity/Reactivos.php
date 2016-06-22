<?php

namespace AreasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reactivos
 */
class Reactivos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $reactivosMaximos;


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
     * Set reactivosMaximos
     *
     * @param integer $reactivosMaximos
     * @return Reactivos
     */
    public function setReactivosMaximos($reactivosMaximos)
    {
        $this->reactivosMaximos = $reactivosMaximos;

        return $this;
    }

    /**
     * Get reactivosMaximos
     *
     * @return integer 
     */
    public function getReactivosMaximos()
    {
        return $this->reactivosMaximos;
    }
    /**
     * @var \AreasBundle\Entity\Perfil
     */
    private $perfil;


    /**
     * Set perfil
     *
     * @param \AreasBundle\Entity\Perfil $perfil
     * @return Reactivos
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
