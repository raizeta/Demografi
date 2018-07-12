<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pernikahan
 *
 * @ORM\Table(name="pernikahan")
 * @ORM\Entity
 */
class Pernikahan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nama_pernikahan", type="string", length=30, nullable=false)
     */
    private $namaPernikahan;



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
     * Set namaPernikahan
     *
     * @param string $namaPernikahan
     *
     * @return Pernikahan
     */
    public function setNamaPernikahan($namaPernikahan)
    {
        $this->namaPernikahan = $namaPernikahan;

        return $this;
    }

    /**
     * Get namaPernikahan
     *
     * @return string
     */
    public function getNamaPernikahan()
    {
        return $this->namaPernikahan;
    }
}
