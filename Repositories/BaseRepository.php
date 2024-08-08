<?php
require_once (ROOT . '/utils/DB.php');

class BaseRepository
{
    /**
     * @var object
     */
    protected object $db;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primaryKey;

    /**
     * @var array
     */
    protected array $fillables;

    /**
     * list data
     * @return array
     */
    public function list() : array
    {
        return $this->db->select("SELECT * FROM " . $this->table);
    }

    /**
     * List data by column
     * @param $column
     * @param $id
     * @return array
     */
    public function listBy($column, $id) : array
    {
        return $this->db->select("SELECT * FROM " . $this->table . " WHERE $column=?", [$id]);
    }

    /**
     * Insert data
     * @param array $data
     * @return int
     */
    public function create(array $data = []) : int
    {
        //Filter valid columns based on fillables
        $filteredData = $this->filterFillables($data);

        if (!$filteredData) {
            return 0;
        }

        $sqlColumn = implode(',', array_keys($filteredData));
        $sqlValue = implode(',', preg_filter('/^/', ':', array_keys($filteredData)));

        $sql = "INSERT INTO " . $this->table . " ($sqlColumn) VALUE ($sqlValue)";

        $this->db->exec($sql, $filteredData);

        return $this->db->lastInsertId();
    }

    /**
     * Delete data
     * @param $id
     * @return int
     */
    public function delete($id) : int
    {
        return $this->db->exec("DELETE FROM " . $this->table . " WHERE id=?", [$id]);
    }

    /**
     * Delete data by
     * @param string $column
     * @param int $id
     * @return int
     */
    public function deleteBy(string $column,int $id) : int
    {
        return $this->db->exec("DELETE FROM " . $this->table . " WHERE $column=?", [$id]);
    }

    /**
     * Filter valid columns based on fillables
     * @param array $data
     * @return array
     */
    public function filterFillables(array $data) {

        if (empty($this->fillables)) {
            return $data;
        }

        $onlyKeys = $this->fillables;

        return array_filter($data, function($v) use ($onlyKeys) {
            return in_array($v, $onlyKeys);
        }, ARRAY_FILTER_USE_KEY);
    }
}