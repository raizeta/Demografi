<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kelamin
 *
 * @ORM\Table(name="kelamin")
 * @ORM\Entity
 */
class Kelamin
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
     * @ORM\Column(name="nama_kelamin", type="string", length=20, nullable=false)
     */
    private $namaKelamin;



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
     * Set namaKelamin
     *
     * @param string $namaKelamin
     *
     * @return Kelamin
     */
    public function setNamaKelamin($namaKelamin)
    {
        $this->namaKelamin = $namaKelamin;

        return $this;
    }

    /**
     * Get namaKelamin
     *
     * @return string
     */
    public function getNamaKelamin()
    {
        return $this->namaKelamin;
    }
}
