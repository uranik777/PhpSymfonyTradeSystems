<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transferdetails
 *
 * @ORM\Table(name="transferdetails")
 * @ORM\Entity
 */
class Transferdetails
{
    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $guid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=1024, nullable=false)
     */
    private $details;

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }


}
