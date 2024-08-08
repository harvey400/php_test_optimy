<?php
require_once (ROOT. '/Repositories/BaseRepository.php');

class NewsRepository extends BaseRepository
{
    use SingletonTrait;

    protected object $db;

    protected string $table = 'news';

    protected string $primaryKey = 'id';

    /**
     * Valid fillable columns of this table
     * @var array|string[]
     */
    protected array $fillables = [
        'title',
        'body',
        'created_at',
    ];

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}