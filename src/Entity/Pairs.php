<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pairs
 *
 * @ORM\Table(name="pairs")
 * @ORM\Entity
 */
class Pairs
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
     * @ORM\Column(name="currency1", type="string", length=64, nullable=false)
     */
    private $currency1;

    /**
     * @var string
     *
     * @ORM\Column(name="currency2", type="string", length=64, nullable=false)
     */
    private $currency2;

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function getCurrency1(): ?string
    {
        return $this->currency1;
    }

    public function setCurrency1(string $currency1): self
    {
        $this->currency1 = $currency1;

        return $this;
    }

    public function getCurrency2(): ?string
    {
        return $this->currency2;
    }

    public function setCurrency2(string $currency2): self
    {
        $this->currency2 = $currency2;

        return $this;
    }


}
