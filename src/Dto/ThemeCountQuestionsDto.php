<?php

namespace App\Dto;

use App\Entity\Theme;

class ThemeCountQuestionsDto
{
    private int $id;
    private string $title;
    private int $nbQuestions;

    //Pas de constructeur
    // Par défaut PHP créé un constructeur par défaut

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getnbQuestions(): int
    {
        return $this->nbQuestions;
    }

    /**
     * @param int $nbQuestions
     */
    public function setnbQuestions(int $nbQuestions): void
    {
        $this->nbQuestions = $nbQuestions;
    }
}