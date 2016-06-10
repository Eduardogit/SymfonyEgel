<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preguntas
 */
class Preguntas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $pregunta;

    /**
     * @var string
     */
    private $respuestaCorrecta;


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
     * Set pregunta
     *
     * @param string $pregunta
     * @return Preguntas
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    /**
     * Get pregunta
     *
     * @return string 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set respuestaCorrecta
     *
     * @param string $respuestaCorrecta
     * @return Preguntas
     */
    public function setRespuestaCorrecta($respuestaCorrecta)
    {
        $this->respuestaCorrecta = $respuestaCorrecta;

        return $this;
    }

    /**
     * Get respuestaCorrecta
     *
     * @return string 
     */
    public function getRespuestaCorrecta()
    {
        return $this->respuestaCorrecta;
    }
    /**
     * @var string
     */
    private $descripcion;


    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Preguntas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * @var \AreasBundle\Entity\SubArea
     */
    private $subarea;


    /**
     * Set subarea
     *
     * @param \AreasBundle\Entity\SubArea $subarea
     * @return Preguntas
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
     * Constructor
     */
    public function __construct()
    {
        $this->subarea = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subarea
     *
     * @param \AreasBundle\Entity\SubArea $subarea
     * @return Preguntas
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



    /*OPCIONES*/

    private $opciones;


    /**
     * Set opciones
     *
     * @param \testBundle\Entity\opciones $opciones
     * @return Opciones
     */
    public function setOpciones(\testBundle\Entity\Opciones $opciones = null)
    {
        $this->opciones = $opciones;

        return $this;
    }

    /**
     * Get opciones
     *
     * @return \testBundle\Entity\opciones 
     */
    public function getOpciones()
    {
        return $this->opciones;
    }
}
