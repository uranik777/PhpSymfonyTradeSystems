<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Balance
 *
 * @ORM\Table(name="balance")
 * @ORM\Entity
 */
class Balance
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="userguid", type="string", length=36, nullable=false)
     */
    private $userguid;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=128, nullable=false)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=28, scale=8, nullable=false)
     */
    private $amount;

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function getUserguid(): ?string
    {
        return $this->userguid;
    }

    public function setUserguid(string $userguid): self
    {
        $this->userguid = $userguid;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }


}
