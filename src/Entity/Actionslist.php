<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actionslist
 *
 * @ORM\Table(name="actionslist")
 * @ORM\Entity
 */
class Actionslist
{
    /**
     * @var string
     *
     * @ORM\Column(name="actionguid", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $actionguid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    public function getActionguid(): ?string
    {
        return $this->actionguid;
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
