<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opciones
 */
class Opciones
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $opcion;


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
     * Set opcion
     *
     * @param string $opcion
     * @return Opciones
     */
    public function setOpcion($opcion)
    {
        $this->opcion = $opcion;

        return $this;
    }

    /**
     * Get opcion
     *
     * @return string 
     */
    public function getOpcion()
    {
        return $this->opcion;
    }
    /**
     * @var \AreasBundle\Entity\SubArea
     */
    private $subarea;


    /**
     * Set subarea
     *
     * @param \AreasBundle\Entity\SubArea $subarea
     * @return Opciones
     */
    public function setSubarea(\AreasBundle\Entity\SubArea $subarea = null)
    {
        $this->subarea = $subarea;

        return $this;
    }

    /**
     * Get subarea
     *
     * @return \AreasBundle\Entity\SubArea 
     */
    public function getSubarea()
    {
        return $this->subarea;
    }
    /**
     * @var \AreasBundle\Entity\Preguntas
     */
    private $pregunta;


    /**
     * Set pregunta
     *
     * @param \AreasBundle\Entity\Preguntas $pregunta
     * @return Opciones
     */
    public function setPregunta(\AreasBundle\Entity\Preguntas $pregunta = null)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \AreasBundle\Entity\Preguntas 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }


    
   
   
}
