<?php
/**
 * @author Harvey Tapang <harveytapang@gmail.com>
 */

require_once(ROOT . '/Repositories/CommentRepository.php');
require_once(ROOT . '/class/Comment.php');

class CommentService
{
    use SingletonTrait;

    /**
     * @var CommentRepository|mixed
     */
    public CommentRepository $commentRepository;

	private function __construct()
	{
        $this->commentRepository = CommentRepository::getInstance();
	}

    /**
     * List comments
     * @return array
     */
	public function list() : array
	{
        $rows =  $this->commentRepository->list();

        $comments = [];

		foreach($rows as $row) {
			$commentObject = new Comment();
            $comments[] = $commentObject->setId($row['id'])
              ->setBody($row['body'])
              ->setCreatedAt($row['created_at'])
              ->setNewsId($row['news_id']);
		}

		return $comments;
	}

    /**
     * List comments by news id
     * @param int $id
     * @return array
     */
    public function listByNewsId(int $id) : array
    {
        $rows =  $this->commentRepository->listBy('news_id', $id);

        $comments = [];

        foreach($rows as $row) {
            $commentObject = new Comment();
            $comments[] = $commentObject->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at'])
                ->setNewsId($row['news_id']);
        }

        return $comments;
    }

    /**
     * Create comment for news
     * @param string $body
     * @param int $newsId
     * @return int
     */
	public function create(string $body, int $newsId) : int
	{
        $data = [
            'body' => $body,
            'created_at' => date('Y-m-d'),
            'news_id' =>  $newsId
        ];

        return $this->commentRepository->create($data);
	}

    /**
     * Delete a comment
     * @param int $id
     * @return int
     */
	public function delete(int $id) : int
	{
        return $this->commentRepository->delete($id);
	}

    /**
     * Delete a comment by News_id
     * @param int $id
     * @return int
     */
    public function deleteByNewsId(int $id) : int
    {
        return $this->commentRepository->deleteBy('news_id', $id);
    }
}