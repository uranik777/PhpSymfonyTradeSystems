<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marketplace
 *
 * @ORM\Table(name="marketplace")
 * @ORM\Entity
 */
class Marketplace
{
    /**
     * @var string
     *
     * @ORM\Column(name="marketguid", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $marketguid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="apiurl", type="string", length=512, nullable=false)
     */
    private $apiurl;

    public function getMarketguid(): ?string
    {
        return $this->marketguid;
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

    public function getApiurl(): ?string
    {
        return $this->apiurl;
    }

    public function setApiurl(string $apiurl): self
    {
        $this->apiurl = $apiurl;

        return $this;
    }


}
