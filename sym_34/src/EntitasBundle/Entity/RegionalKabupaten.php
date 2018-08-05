<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;
/**
 * RegionalKabupaten
 *
 * @ORM\Table(name="regional_kabupaten", indexes={@ORM\Index(name="IDX_4DE3A56CEA5CC336", columns={"propinsis"})})
 * @ORM\Entity
  * @ORM\Entity(repositoryClass="EntitasBundle\Repositories\RegionalKabupatenRepository")
  * @JMSSerializer\ExclusionPolicy("all")
 */
class RegionalKabupaten
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerializer\Expose
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_kabupaten", type="integer", nullable=false)
     * @JMSSerializer\Expose
     * @Assert\NotBlank(message="ID Kabupaten Tidak Boleh Kosong")
     */
    private $idKabupaten;

    /**
     * @var string
     *
     * @ORM\Column(name="nama_kabupaten", type="string", length=255, nullable=false)
     * @JMSSerializer\Expose
     * @Assert\NotBlank(message="Nama Kabupaten Tidak Boleh Kosong")
     */
    private $namaKabupaten;

    /**
     * @var string
     *
     * @ORM\Column(name="type_kabupaten", type="string", length=255, nullable=false)
     * @JMSSerializer\Expose
     * @Assert\NotBlank(message="Type Kabupaten/Kota Tidak Boleh Kosong")
     */
    private $typeKabupaten;

    /**
     * @var integer
     *
     * @ORM\Column(name="kode_pos", type="integer", nullable=false)
     * @JMSSerializer\Expose
     * @Assert\NotBlank(message="Kode Pos Tidak Boleh Kosong")
     */
    private $kodePos;

    /**
     * @var \RegionalPropinsi
     *
     * @ORM\ManyToOne(targetEntity="RegionalPropinsi",inversedBy="kabupatens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propinsis", referencedColumnName="id")
     * })
     * @JMSSerializer\Expose
     * @Assert\NotBlank(message="ID Propinsi Tidak Boleh Kosong")
     */
    private $propinsis;

    /**
     * @ORM\OneToMany(targetEntity="RegionalKecamatan", mappedBy="kabupatens")
     * @JMSSerializer\Exclude
     */
    protected $kecamatans;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kecamatans = new ArrayCollection();
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
     * Set idKabupaten
     *
     * @param integer $idKabupaten
     *
     * @return RegionalKabupaten
     */
    public function setIdKabupaten($idKabupaten)
    {
        $this->idKabupaten = $idKabupaten;

        return $this;
    }

    /**
     * Get idKabupaten
     *
     * @return integer
     */
    public function getIdKabupaten()
    {
        return $this->idKabupaten;
    }

    /**
     * Set namaKabupaten
     *
     * @param string $namaKabupaten
     *
     * @return RegionalKabupaten
     */
    public function setNamaKabupaten($namaKabupaten)
    {
        $this->namaKabupaten = $namaKabupaten;

        return $this;
    }

    /**
     * Get namaKabupaten
     *
     * @return string
     */
    public function getNamaKabupaten()
    {
        return $this->namaKabupaten;
    }

    /**
     * Set typeKabupaten
     *
     * @param string $typeKabupaten
     *
     * @return RegionalKabupaten
     */
    public function setTypeKabupaten($typeKabupaten)
    {
        $this->typeKabupaten = $typeKabupaten;

        return $this;
    }

    /**
     * Get typeKabupaten
     *
     * @return string
     */
    public function getTypeKabupaten()
    {
        return $this->typeKabupaten;
    }

    /**
     * Set kodePos
     *
     * @param integer $kodePos
     *
     * @return RegionalKabupaten
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
     * Set propinsis
     *
     * @param \EntitasBundle\Entity\RegionalPropinsi $propinsis
     *
     * @return RegionalKabupaten
     */
    public function setPropinsis(\EntitasBundle\Entity\RegionalPropinsi $propinsis = null)
    {
        $this->propinsis = $propinsis;

        return $this;
    }

    /**
     * Get propinsis
     *
     * @return \EntitasBundle\Entity\RegionalPropinsi
     */
    public function getPropinsis()
    {
        return $this->propinsis;
    }

    /**
     * Add kecamatan
     *
     * @param \EntitasBundle\Entity\RegionalKecamatan $kecamatan
     *
     * @return RegionalKabupaten
     */
    public function addKecamatan(\EntitasBundle\Entity\RegionalKecamatan $kecamatan)
    {
        $this->kecamatans[] = $kecamatan;

        return $this;
    }

    /**
     * Remove kecamatan
     *
     * @param \EntitasBundle\Entity\RegionalKecamatan $kecamatan
     */
    public function removeKecamatan(\EntitasBundle\Entity\RegionalKecamatan $kecamatan)
    {
        $this->kecamatans->removeElement($kecamatan);
    }

    /**
     * Get kecamatans
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKecamatans()
    {
        return $this->kecamatans;
    }
}
