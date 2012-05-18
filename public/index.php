<?php
// this is a sample code for using web framework
// Yuu Ito 2012/05/18

require '../vender/Slim/Slim/Slim.php';
require '../vender/Slim-Extras/Views/TwigView.php';

TwigView::$twigDirectory = '../vender/Twig/lib/Twig';

$config = array(
  'log.enable' => true,
  'log.path' => '../logs',
  'log.level' => 4,
  'debug' => true,
  'view' => 'TwigView', // use template engin for Twig
  'templates.path' => '../vender/views/'
);

$app = new Slim($config);
$app->get('/',function() use ($app){
  // hoge
  $app->view()->setData(array('title'=>'This is top page!','body'=>'hoge'));
  $app->render('top.html');
});

$app->get('/hoge','hoge_method');
function hoge_method(){
  $app = Slim::getInstance();
  $app->render('top.html',array('title'=>'hoge page','body'=>'hoge body'));
}

$app->get('/dbaccess',function() use ($app){

  try{
    $pdo = new PDO('mysql:dbname=blog_db;host:localhost','myuser','mypassword');
  } catch (PDOException $e) {
    exit('cannot access database ' . $e->getMessage());
  }
  
  $stmt = $pdo->query('SELECT id, title FROM post');

  $result = array();
  while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($result, $data);
  }

  $app->render('top.html',array('title'=>'Test: DB access','posts'=>$result));

});


$app->run();


