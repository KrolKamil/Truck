<?php

class Transit
{
    private $db;
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

    public function addTransit($sourceAddress, $destinationAddress, $price, $date)
    {
        $sql = "INSERT INTO transit (id, source_address, destination_address, price, date)
                VALUES ('', :source_address, :destination_address, :price, :date)";

        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute([
            "source_address" => $sourceAddress,
            "destination_address" => $destinationAddress,
            "price" => $price,
            "date" => $date
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }

    }


}