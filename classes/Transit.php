<?php

class Transit
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTransits()
    {
        $data = [];

        $sql = "SELECT * FROM transit";
        $stm = $this->db->query($sql);

        while ($row = $stm->fetch())
            $data[] = $row;


        return $data;
    }

}