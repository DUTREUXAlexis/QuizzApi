<?php

namespace App\Controller;
use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuizzController extends AbstractController
{
    #[Route('/api/themes', name: 'app_api_themes')]
    public function themes(ThemeRepository $repository, SerializerInterface $serializer): Response
    {
        $themes = $repository->findAll();
        $themeJson = $serializer->serialize($themes,"json",["groups"=>["theme"]]);
        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set("content-type","application/json");
        $response->setContent($themeJson);
        return $response;
    }

    #[Route('/api/{theme}/{nombreQuestions}', name: 'app_api_theme_questions')]
    public function questionsParThemes(QuestionRepository $repository, ThemeRepository $themeRepository, SerializerInterface $serializer, $theme,$nombreQuestions ): Response
    {
        $themeobj = $themeRepository->findOneBy(["Titre"=>$theme]);
        $questions = $repository->findBy(["theme"=>$themeobj]);
        shuffle($questions);
        $tableauQuestions = array_slice($questions,0,$nombreQuestions);
        $questionjson = $serializer->serialize($tableauQuestions,"json",["groups"=>["theme","questions"]]);
        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set("content-type","application/json");
        $response->setContent($questionjson);
        return $response;
    }
}