<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/noticias/{category?}',defaults:["category"=>""], name: 'app_noticias')]
    public function index($category): Response
    {
        $noticias = $this->generateNews();
        $filteredNews = $this->filterNewsByIndex('category',$noticias, $category);
        return $this->render('test/index.html.twig', [
            'noticias' => $category!=""?$filteredNews:$noticias,
            'category' => $category
        ]);
    }

    #[Route('/noticias/detalle/{id?}',defaults:["id"=>""], name: 'app_noticias_detalle')]
    public function detalle(int $id): Response
    {
        $noticias = $this->generateNews();
        $filterNew = $this->filterNewsByIndex('id',$noticias, $id);
       
        return $this->render('test/detail/index.html.twig', [
            'noticia' => $filterNew,
        ]);
    }

    private function generateNews(): Array
    {
       return [
        [
            'id'=> 1,
            'url'=>'images/symfony.jpg',
            'category'=>'tecnología',
            'title'=>'La IA dominará el mundo',
            'content'=>'Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia',
        ],
        [
            'id'=> 2,
            'url'=>'images/a.jpg',
            'category'=>'tecnología',
            'title'=>'La IA dominará el mundo2',
            'content'=>'Lorem Hola Mundo2, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia',
        ],
        [
            'id'=> 3,
            'url'=>'images/symfony.jpg',
            'category'=>'tecnología',
            'title'=>'La IA dominará el mundo3',
            'content'=>'Lorem Hola Mundo3, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, primera Noticia',
        ],
        [
            'id'=> 4,
            'url'=>'images/a.jpg',
            'category'=>'deportes',
            'title'=>'Lo nuevo del futbol',
            'content'=>'Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia',
        ],
        [
            'id'=> 5,
            'url'=>'images/symfony.jpg',
            'category'=>'arte',
            'title'=>'Lo nuevo del arte',
            'content'=>'Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia',
        ],
        [
            'id'=> 6,
            'url'=>'images/a.jpg',
            'category'=>'ciencia',
            'title'=>'Lo nuevo de las ciencas',
            'content'=>'Lorem Hola Mundo, primera Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia,Lorem Hola Mundo, segunda Noticia',
        ]
       ];
    }

    private function filterNewsByIndex(string $index, array $newsArray, string $val) {
        $filteredNews = [];
    
        foreach ($newsArray as $news) {
            if ($news[$index] == $val) {
                $filteredNews[] = $news;
            }
        }
    
        return $filteredNews;
    }

    
}
