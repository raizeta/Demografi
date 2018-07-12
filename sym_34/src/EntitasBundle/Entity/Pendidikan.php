<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pendidikan
 *
 * @ORM\Table(name="pendidikan")
 * @ORM\Entity
 */
class Pendidikan
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
     * @ORM\Column(name="nama_pendidikan", type="string", length=50, nullable=false)
     */
    private $namaPendidikan;



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
     * Set namaPendidikan
     *
     * @param string $namaPendidikan
     *
     * @return Pendidikan
     */
    public function setNamaPendidikan($namaPendidikan)
    {
        $this->namaPendidikan = $namaPendidikan;

        return $this;
    }

    /**
     * Get namaPendidikan
     *
     * @return string
     */
    public function getNamaPendidikan()
    {
        return $this->namaPendidikan;
    }
}
