<?php

namespace App\Services;

class UrlsService extends BaseService
{
    protected $table = 'urls';
    protected $usersTable = 'users';

    public function getOneUser($username)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->usersTable} WHERE username=?", [(string) $username]);
    }

    public function getOne($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->table} WHERE id=?", [(int) $id]);
    }

    public function getOneByHash($hash)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->table} WHERE hash=?", [$hash]);
    }

    public function getUrlsStats()
    {
        return $this->db->fetchAll("SELECT * FROM {$this->table} ORDER BY hits DESC LIMIT 10");
    }

    public function getUrlsStatsCount()
    {
        return $this->db->fetchAssoc("SELECT COUNT(id) AS url_count, SUM(hits) AS hits_sum FROM {$this->table}");
    }

    public function save($params)
    {
        $this->db->insert($this->table, $params);
        return $this->db->lastInsertId('urls_id_seq');
    }

    public function update($id, $params)
    {
        return $this->db->update($this->table, $params, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
