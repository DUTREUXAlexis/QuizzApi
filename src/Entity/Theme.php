<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['List_Themes','Detail_Theme'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['List_Themes','Detail_Theme'])]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['Detail_Theme'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'idtheme', targetEntity: Question::class)]
    #[Groups(['list_questions'])]
    private Collection $Questions;

    public function __construct()
    {
        $this->Questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->Questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->Questions->contains($question)) {
            $this->Questions->add($question);
            $question->setIdtheme($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->Questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getIdtheme() === $this) {
                $question->setIdtheme(null);
            }
        }

        return $this;
    }
}
