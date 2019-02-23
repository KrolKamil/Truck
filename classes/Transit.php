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
        $sql = "SELECT 
                ROUND(SUM(distance), 1) AS total_distance,
                ROUND(SUM(price),2) AS total_price
                FROM transit 
                WHERE date BETWEEN :start_date AND :end_date";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
           "start_date" => $startDate,
           "end_date" => $endDate
        ]);
        return $stmt->fetch();
    }

    public function getMonthlyReport()
    {
        $date = getdate();
        if($date['mday'] != 0)
        {
            $data = [];
            $startDate = $date["year"] . '-' . $date["mon"] . '-1';
            $endDate = $date["year"] . '-' . $date["mon"] . '-' . ($date['mday'] -1);


            $sql = "SELECT date AS date,
                 ROUND(SUM(distance),1) AS total_distance,
                 ROUND(AVG(distance),1) AS avg_distance,
                 ROUND(AVG(price),2) AS avg_price
                 FROM transit WHERE
                 date BETWEEN :start_date AND :end_date GROUP BY date";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
               "start_date" => $startDate,
               "end_date" => $endDate
            ]);

            while ($row = $stmt->fetch())
                $data[] = $row;

            return $data;
        }
        return false;
    }


}