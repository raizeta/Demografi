<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * RegionalPropinsi
 *
 * @ORM\Table(name="regional_propinsi")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="EntitasBundle\Repositories\RegionalPropinsiRepository")
 * @JMSSerializer\ExclusionPolicy("all")
 */
class RegionalPropinsi
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
     * @var string
     *
     * @ORM\Column(name="namapropinsi", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Nama Propinsi Tidak Boleh Kosong")
     * @JMSSerializer\Expose
     */
    private $namapropinsi;

    /**
     * @ORM\OneToMany(targetEntity="RegionalKabupaten", mappedBy="propinsis")
     * @JMSSerializer\Exclude
     */
    protected $kabupatens;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kabupatens = new ArrayCollection();
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
     * Set namapropinsi
     *
     * @param string $namapropinsi
     *
     * @return RegionalPropinsi
     */
    public function setNamapropinsi($namapropinsi)
    {
        $this->namapropinsi = $namapropinsi;

        return $this;
    }

    /**
     * Get namapropinsi
     *
     * @return string
     */
    public function getNamapropinsi()
    {
        return $this->namapropinsi;
    }

    /**
     * Add kabupaten
     *
     * @param \EntitasBundle\Entity\RegionalKabupaten $kabupaten
     *
     * @return RegionalPropinsi
     */
    public function addKabupaten(\EntitasBundle\Entity\RegionalKabupaten $kabupaten)
    {
        $this->kabupatens[] = $kabupaten;

        return $this;
    }

    /**
     * Remove kabupaten
     *
     * @param \EntitasBundle\Entity\RegionalKabupaten $kabupaten
     */
    public function removeKabupaten(\EntitasBundle\Entity\RegionalKabupaten $kabupaten)
    {
        $this->kabupatens->removeElement($kabupaten);
    }

    /**
     * Get kabupatens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKabupatens()
    {
        return $this->kabupatens;
    }
}
