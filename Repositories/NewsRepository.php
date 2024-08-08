<?php
require_once (ROOT. '/Repositories/BaseRepository.php');

class NewsRepository extends BaseRepository
{
    use SingletonTrait;

    /**
     * @var object|mixed
     */
    protected object $db;

    /**
     * Table name
     * @var string
     */
    protected string $table = 'news';

    /**
     * Primary key
     * @var string
     */
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