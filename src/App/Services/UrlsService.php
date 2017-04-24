<?php

namespace App\Services;

class UrlsService extends BaseService
{
	protected $table = "urls";
	protected $usersTable = "users";

    public function getOneUser($username)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->usersTable} WHERE username=?", [(string) $username]);
    }

    public function getOne($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM {$this->table} WHERE id=?", [(int) $id]);
    }

    function save($params)
    {
        $this->db->insert($this->table, $params);
        return $this->db->lastInsertId("urls_id_seq");
    }

    function update($id, $params)
    {
        return $this->db->update($this->table, $params, ['id' => $id]);
    }
}
