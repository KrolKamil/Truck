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

    public function addTransit($sourceAddress, $destinationAddress, $price, $distance, $date)
    {
        $sql = "INSERT INTO transit (id, source_address, destination_address, price, distance, date)
                VALUES ('', :source_address, :destination_address, :price, :distance, :date)";

        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute([
            "source_address" => $sourceAddress,
            "destination_address" => $destinationAddress,
            "price" => $price,
            "distance" => $distance,
            "date" => $date
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }

    }

    public function getReport($startDate, $endDate)
    {
        $sql = "SELECT SUM(price) AS total_distance, SUM(distance) AS total_price FROM transit WHERE date BETWEEN :start_date AND :end_date";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
           "start_date" => $startDate,
           "end_date" => $endDate
        ]);
        return $stmt->fetch();
    }


}