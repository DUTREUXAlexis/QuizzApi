<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("questions")]
    private ?string $texte = null;

    #[ORM\Column(type: Types::ARRAY)]
    #[Groups("questions")]
    private array $reponses = [];

    #[ORM\Column(length: 255)]
    #[Groups("questions")]
    private ?string $reponseJuste = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?theme $theme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getReponses(): array
    {
        return $this->reponses;
    }

    public function setReponses(array $reponses): self
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getReponseJuste(): ?string
    {
        return $this->reponseJuste;
    }

    public function setReponseJuste(string $reponseJuste): self
    {
        $this->reponseJuste = $reponseJuste;

        return $this;
    }

    public function getTheme(): ?theme
    {
        return $this->theme;
    }

    public function setTheme(?theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
