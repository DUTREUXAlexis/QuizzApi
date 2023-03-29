<?php

namespace App\Controller;

use App\Dto\ThemeCountQuestionsDto;
use App\Entity\Theme;
use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;
    private QuestionRepository $questionRepository;

    /**
     * @param ThemeRepository $themeRepository
     * @param SerializerInterface $serializer
     * @param QuestionRepository $questionRepository
     */
    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer, QuestionRepository $questionRepository)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
        $this->questionRepository = $questionRepository;
    }

    #[Route('/api/theme', name: 'api_theme')]
    public function getThemes(SerializerInterface $serializer): Response
    {
        $theme = $this->themeRepository->findAll();
        $themeJS = $serializer->serialize($theme,'json'
        ,['groups' => 'List_Themes']);
        return new Response($themeJS,Response::HTTP_OK,
        ["content-type" => "application/json"]);
    }

 #[Route('/api/theme/{id}', name: 'api_theme_id')]
 public function getThemeById(SerializerInterface $serializer,int $id): Response
 {
     $theme = $this->themeRepository->findOneBy(['id' => $id]);

     $themeJS = $serializer->serialize($theme,'json',
     ['groups' => 'Detail_Theme']);
     return new Response($themeJS,Response::HTTP_OK,
         ["content-type" => "application/json"]);

 }

#[Route('/api/theme/{id}/Question', name: 'api_theme_questions')]
public function getQuestionsByThemes(SerializerInterface $serializer,int $id): Response
{
    $theme = $this->themeRepository->findOneBy(['id' => $id]);
    $dto = new ThemeCountQuestionsDto();
    $dto->setId($id);
    $dto->setTitle($theme->getLibelle());
    $dto->setnbQuestions(count($theme->getQuestions()));
    $themeJS = $this->serializer->serialize($theme,
        'json',['groups' => 'list_questions']);
    return new Response($themeJS,Response::HTTP_OK,
    ["content-type" => "application/json"]);
}

    #[Route('/api/theme/{libelle}/Question/{NbQuestion}', name: 'api_theme_questions')]
    public function getQuizzByThemes($NbQuestion,SerializerInterface $serializer,$libelle): Response
    {
        $themeId = $this->themeRepository->findOneBy(['libelle' => $libelle]);
        $Questions = $this->questionRepository->findBy(['idtheme' => $themeId]);

        shuffle($Questions);
        $Question = [];
        for($i = 1; $i < $NbQuestion; $i++)
        {
            array_push($Question, $Questions[$i+1]);
        }

        $QuestionJS = $this->serializer->serialize($Question,'json'
        ,['groups' => 'liste_question_Nb']);

        return new Response($QuestionJS,Response::HTTP_OK,
            ["content-type" => "application/json"]);
    }

}
