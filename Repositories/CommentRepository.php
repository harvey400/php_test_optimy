<?php
/**
 * @author Harvey Tapang <harveytapang@gmail.com>
 */

require_once (ROOT. '/Repositories/BaseRepository.php');

class CommentRepository extends BaseRepository
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
    protected string $table = 'comment';

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
        'body',
        'created_at',
        'news_id',
    ];

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
