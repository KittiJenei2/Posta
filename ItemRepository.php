<?php
class ItemRepository
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "postoffice");
        $this->mysqli->set_charset("utf8mb4");
        if ($this->mysqli->connect_error) {
            die("Connection failled:". $this->mysqli->connect_error);
        }
    }

    public function getAllCounties()
    {
        $counties = [];

        $sql = "SELECT * FROM  counties";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $counties[] = $row;
            }
        }

        return $counties;
    }

    public function getCitiesByCountyId()
    {
        $cities = [];

        $sql = "SELECT * FROM cities WHERE id_county = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row;
            }
        }
    }

    public function closeConnection()
    {
        $this->mysqli->close();
    }
    public function getCountyById($countyId)
    {

        $sql = "SELECT * FROM counties WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                return $row;
           } else {
            return 'Nincs ilyen megye';
           }
    }

    public function saveCounty($countyName) {
        $sql = 'INSERT INTO counties (name) VALUES (?)';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $countyName);

        $stmt->execute();
    }

    public function updateCounty($countyId, $countyName){
        $sql = 'UPDATE counties SET name = ? WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si',$countyName, $countyId);

        $stmt->execute();
    } 

    public function searchCounty($needle){
        $sql = "SELECT * FROM counties WHERE name LIKE '%$needle%'";
        $stmt = $this->mysqli->prepare($sql);
        //$stmt->bind_param('s', $needle);

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $counties[] = $row;
            }
        }

        return $counties;
    }

    public function deleteCounty($countyId){
        $sql = 'DELETE FROM counties WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i",$countyId);

        $stmt->execute();
    }
}