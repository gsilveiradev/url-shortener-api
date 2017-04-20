<?php

namespace App\Services;

class UsersService extends BaseService
{
    protected $table = "users";

    public function getOne($username)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->table} WHERE username=?", [(string) $username]);
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }

    function save($params)
    {
        $this->db->insert($this->table, $params);
        return $this->db->lastInsertId();
    }

    function update($id, $params)
    {
        return $this->db->update($this->table, $params, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}
