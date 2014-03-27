<?php
use \Illuminate\Database\Capsule\Manager as Capsule;
use \Phpmig\Adapter;


// replace this with a better Phpmig\Adapter\AdapterInterface
//$container['phpmig.adapter'] = new Adapter\File\Flat(__DIR__ . DIRECTORY_SEPARATOR . 'migrations/.migrations.log');


$container = new \Phpmig\Pimple\Pimple();

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

$container["config"] = array(
  "driver" => "sqlite",
  "database" => __DIR__ . "/db/db.sqlite",
  "prefix" => ""
);
echo __DIR__;
$container["db"] = $container->share(function($container){
  return new PDO("sqlite:" . $container["config"]["database"]);
});
$container["schema"] = $container->share( function($container){
  $capsule = new Capsule;
  $capsule->addConnection($container["config"]);
  $capsule->setAsGlobal();
  return Capsule::schema();
});

$container["phpmig.adapter"] = $container->share(function() use($container){
  return new Phpmig\Adapter\PDO\Sql($container["db"], "migrations");
});
// You can also provide an array of migration files
// $container['phpmig.migrations'] = array_merge(
//     glob('migrations_1/*.php'),
//     glob('migrations_2/*.php')
// );

return $container;
