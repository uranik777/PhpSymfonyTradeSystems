<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Algoritm
 *
 * @ORM\Table(name="algoritm")
 * @ORM\Entity
 */
class Algoritm
{
    /**
     * @var string
     *
     * @ORM\Column(name="algoritmguid", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $algoritmguid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    public function getAlgoritmguid(): ?string
    {
        return $this->algoritmguid;
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


}
