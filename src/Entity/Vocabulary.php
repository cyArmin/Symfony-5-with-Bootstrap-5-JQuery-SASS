<?php

namespace App\Entity;

use App\Repository\VocabularyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VocabularyRepository::class)
 */
class Vocabulary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $german;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $spanish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerman(): ?string
    {
        return $this->german;
    }

    public function setGerman(string $german): self
    {
        $this->german = $german;

        return $this;
    }

    public function getSpanish(): ?string
    {
        return $this->spanish;
    }

    public function setSpanish(string $spanish): self
    {
        $this->spanish = $spanish;

        return $this;
    }
}
