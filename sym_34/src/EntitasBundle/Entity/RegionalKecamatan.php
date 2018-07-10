<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegionalKecamatan
 *
 * @ORM\Table(name="regional_kecamatan", indexes={@ORM\Index(name="IDX_B8576989A4851CF", columns={"kabupatens"})})
 * @ORM\Entity
 */
class RegionalKecamatan
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
     * @var integer
     *
     * @ORM\Column(name="id_kecamatan", type="integer", nullable=false)
     */
    private $idKecamatan;

    /**
     * @var string
     *
     * @ORM\Column(name="nama_kecamatan", type="string", length=255, nullable=false)
     */
    private $namaKecamatan;

    /**
     * @var integer
     *
     * @ORM\Column(name="kode_pos", type="integer", nullable=true)
     */
    private $kodePos;

    /**
     * @var \RegionalKabupaten
     *
     * @ORM\ManyToOne(targetEntity="RegionalKabupaten",inversedBy="kecamatans")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kabupatens", referencedColumnName="id")
     * })
     */
    private $kabupatens;

    



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
     * Set idKecamatan
     *
     * @param integer $idKecamatan
     *
     * @return RegionalKecamatan
     */
    public function setIdKecamatan($idKecamatan)
    {
        $this->idKecamatan = $idKecamatan;

        return $this;
    }

    /**
     * Get idKecamatan
     *
     * @return integer
     */
    public function getIdKecamatan()
    {
        return $this->idKecamatan;
    }

    /**
     * Set namaKecamatan
     *
     * @param string $namaKecamatan
     *
     * @return RegionalKecamatan
     */
    public function setNamaKecamatan($namaKecamatan)
    {
        $this->namaKecamatan = $namaKecamatan;

        return $this;
    }

    /**
     * Get namaKecamatan
     *
     * @return string
     */
    public function getNamaKecamatan()
    {
        return $this->namaKecamatan;
    }

    /**
     * Set kodePos
     *
     * @param integer $kodePos
     *
     * @return RegionalKecamatan
     */
    public function setKodePos($kodePos)
    {
        $this->kodePos = $kodePos;

        return $this;
    }

    /**
     * Get kodePos
     *
     * @return integer
     */
    public function getKodePos()
    {
        return $this->kodePos;
    }

    /**
     * Set kabupatens
     *
     * @param \EntitasBundle\Entity\RegionalKabupaten $kabupatens
     *
     * @return RegionalKecamatan
     */
    public function setKabupatens(\EntitasBundle\Entity\RegionalKabupaten $kabupatens = null)
    {
        $this->kabupatens = $kabupatens;

        return $this;
    }

    /**
     * Get kabupatens
     *
     * @return \EntitasBundle\Entity\RegionalKabupaten
     */
    public function getKabupatens()
    {
        return $this->kabupatens;
    }
}
