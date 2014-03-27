<?php
require_once __DIR__."/../vendor/autoload.php";

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => __DIR__."/../views",
));

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(
  array(
    "driver" => "sqlite",
    "database" => __DIR__ . "/../db/db.sqlite",
    "prefix" => ""
  )
);
$capsule->bootEloquent();
use Dflydev\Silex\Provider\Psr0ResourceLocator\Psr0ResourceLocatorServiceProvider;
use Dflydev\Silex\Provider\Psr0ResourceLocator\Composer\ComposerResourceLocatorServiceProvider;
$app->register(new Psr0ResourceLocatorServiceProvider);
$app->register(new ComposerResourceLocatorServiceProvider);

// Set environment
if (isset($app_env) && in_array($app_env, array("prod", "dev", "test")))
{
  $app["env"] = $app_env;
}
else {
  $app["env"] = "prod";
}

// Debug mode
if($app["debug"])
{
  $app->register( new Whoops\Provider\Silex\WhoopsServiceProvider);
}

$app['article.front.controller'] = $app->share(function() use ($app){
  return new Article\Controller\FrontController($app);
});
$app->get("/", function(){
  return "hello";
});

$app->get("/blog", 'article.front.controller:indexAction');
$app->get("/blog/article/id/{id}",'article.front.controller:getArticleAction')->bind($id);
$app->get("/blog/orm/create/{title}", function($title) use ($app){
  $a = new Article\Entity\Article;
  $a->title = $title;
  $a->save();
  return $a;
});
$app->get("/blog/orm/id/{id}", function($id) use($app){
  $articleModel = new Article\Entity\Article;
  $a = $articleModel::find($id);
  return $a;

});

// Check environment
if($app["env"] === "test")
{
  return $app;
}
else {
  $app->run();
}
