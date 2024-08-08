<?php

define('ROOT', __DIR__);

require_once (ROOT . '/Traits/SingletonTrait.php');
require_once (ROOT . '/Services/NewsService.php');
require_once (ROOT . '/Services/CommentService.php');

$newsService = NewsService::getInstance();
$commentService = CommentService::getInstance();

foreach ($newsService->list() as $news) {
	echo("############ NEWS " . $news->getTitle() . " ############\n");
	echo($news->getBody() . "\n");
	foreach ($commentService->listByNewsId($news->getId()) as $comment) {
        echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
	}
}

$c = $commentService->list();