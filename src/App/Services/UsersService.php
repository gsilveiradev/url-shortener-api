<?php

namespace App\Services;

class UsersService extends BaseService
{
    protected $table = 'users';
    protected $urlsTable = 'urls';

    public function getOne($username)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->table} WHERE username=?", [(string) $username]);
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }

    public function getUrlsStatsByUser($id)
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->urlsTable}
            WHERE user_id=?
            ORDER BY hits DESC
            LIMIT 10",
            [(int) $id]
        );
    }

    public function getUrlsStatsCountByUser($id)
    {
        return $this->db->fetchAssoc(
            "SELECT
                COUNT(id) AS url_count,
                SUM(hits) AS hits_sum
            FROM {$this->urlsTable}
            WHERE user_id=?
            GROUP BY user_id",
            [(int) $id]
        );
    }

    public function save($params)
    {
        $this->db->insert($this->table, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $params)
    {
        return $this->db->update($this->table, $params, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete($this->urlsTable, ['user_id' => $id]);
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
