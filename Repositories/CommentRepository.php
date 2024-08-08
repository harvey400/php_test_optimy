<?php
require_once (ROOT. '/Repositories/BaseRepository.php');

class CommentRepository extends BaseRepository
{
    use SingletonTrait;

    protected object $db;

    protected string $table = 'comment';

    protected string $primaryKey = 'id';

    /**
     * Valid fillable columns of this table
     * @var array|string[]
     */
    protected array $fillables = [
        'body',
        'created_at',
        'news_id',
    ];

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
