<?php
require_once (ROOT . '/autoload.php');

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