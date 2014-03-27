<?php

namespace Article\Controller;
use Article\Entity as Entity;

class FrontController
{
  protected $app;

  public function __construct($app)
  {
    $this->app = $app;
  }

  public function indexAction()
  {
    return $this->app['twig']->render("articles.twig");
  }
  public function getArticleAction($id)
  {
    $a = new Entity\Article;
    $a = $a::find($id);
    $articles = array(
      "articles" => array(
        array(
          "id" => $a->title
        )
      )
    );
    return $this->app['twig']->render("article.twig", $articles);
  }
}
