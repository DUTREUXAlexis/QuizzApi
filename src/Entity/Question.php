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

    #[ORM\ManyToOne(inversedBy: 'Questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $idtheme = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_questions'])]
    private ?string $text = null;

    #[ORM\Column(type: Types::ARRAY)]
    #[Groups(['list_questions'])]
    private array $reponse = [];

    #[ORM\Column(length: 255)]
    #[Groups(['list_questions'])]
    private ?string $reponseJuste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdtheme(): ?Theme
    {
        return $this->idtheme;
    }

    public function setIdtheme(?Theme $idtheme): self
    {
        $this->idtheme = $idtheme;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getReponse(): array
    {
        return $this->reponse;
    }

    public function setReponse(array $reponse): self
    {
        $this->reponse = $reponse;

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
}
