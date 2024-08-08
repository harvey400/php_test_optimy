<?php
/**
 * @author Harvey Tapang <harveytapang@gmail.com>
 */

require_once(ROOT . '/class/News.php');
require_once(ROOT . '/Services/CommentService.php');
require_once(ROOT . '/Repositories/NewsRepository.php');

class NewsService
{
    use SingletonTrait;

    /**
     * @var NewsRepository|mixed
     */
    private NewsRepository $newsRepository;

    /**
     * @var CommentService|mixed
     */
    private CommentService $commentService;

	private function __construct()
	{
        $this->commentService = CommentService::getInstance();
        $this->newsRepository = NewsRepository::getInstance();
	}

    /**
     * List all news
     * @return array
     */
	public function list() : array
	{
        $rows = $this->newsRepository->list();

		$news = [];

		foreach($rows as $row) {
			$newsObject = new News();
			$news[] = $newsObject->setId($row['id'])
			  ->setTitle($row['title'])
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at']);
		}

		return $news;
	}

    /**
     * Add a record in news table
     * @param string $title
     * @param string $body
     * @return int
     */
	public function create(string $title, string $body) : int
	{
        $data = [
            'title' => $title,
            'body' =>  $body,
            'created_at' => date('Y-m-d')
        ];

        return $this->newsRepository->create($data);
	}

    /**
     * Deletes a news, and also linked comments
     * @param int $id
     * @return int
     */
	public function delete(int $id) : int
	{
        /**
         * Delete comments based on NewsId
         */
        $this->commentService->deleteByNewsId($id);

        return $this->newsRepository->delete($id);
	}
}