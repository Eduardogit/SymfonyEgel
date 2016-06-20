<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SetRespuestas
 */
class SetRespuestas
{
    /**
     * @var integer
     */
    private $id;


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
     * @var \testBundle\Entity\Opciones
     */
    private $opcion;


    /**
     * Set opcion
     *
     * @param \testBundle\Entity\Opciones $opcion
     * @return SetRespuestas
     */
    public function setOpcion(\testBundle\Entity\Opciones $opcion = null)
    {
        $this->opcion = $opcion;

        return $this;
    }

    /**
     * Get opcion
     *
     * @return \testBundle\Entity\Opciones 
     */
    public function getOpcion()
    {
        return $this->opcion;
    }
    /**
     * @var \testBundle\Entity\Test
     */
    private $test;


    /**
     * Set test
     *
     * @param \testBundle\Entity\Test $test
     * @return SetRespuestas
     */
    public function setTest(\testBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \testBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }
}
