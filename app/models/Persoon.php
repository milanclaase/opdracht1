<?php
class Persoon
{
  // Properties, fields
  private $db;
  public $helper;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getPersons()
  {
    $this->db->query("SELECT Persoon.*, Contact.*, TypePersoon.* 
    FROM Persoon 
    LEFT JOIN Contact ON Persoon.Id = Contact.PersoonId 
    INNER JOIN TypePersoon ON Persoon.TypePersoonId = TypePersoon.Id 
    ORDER BY Persoon.Achternaam ASC;");
    $result = $this->db->resultSet();
    return $result;
  }
  
  
//   public function getRowsByDate($date) {
//     $conn = $this->db->dbHandler;
//     $stmt = $conn->prepare("SELECT * FROM your_table WHERE DatumAangemaakt = :date");
//     $stmt->bindParam(':date', $date);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }



  public function getSinglePerson($id)
  {
    $this->db->query("SELECT * FROM BowlingInfo WHERE Id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function updatePerson($post)
  {
    try {
      $this->db->dbHandler->beginTransaction();

      $this->db->query("UPDATE BowlingInfo 
                          SET Voornaam = :voornaam,
                              Tussenvoegsel = :tussenvoegsel,
                              Achternaam = :achternaam,
                              Roepnaam = :roepnaam,
                              IsVolwassen = :isVolwassen
                          WHERE Id = :id");

      $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
      $this->db->bind(':voornaam', $post["voornaam"], PDO::PARAM_STR);
      $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"], PDO::PARAM_STR);
      $this->db->bind(':achternaam', $post["achternaam"], PDO::PARAM_STR);
      $this->db->bind(':roepnaam', $post["roepnaam"], PDO::PARAM_STR);
      $this->db->bind(':isVolwassen', $post["isVolwassen"], PDO::PARAM_BOOL);

      return $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage() . "Rollback";
      $this->db->dbHandler->rollBack();
    }
  }

  public function deletePerson($id)
  {
    $this->db->query("DELETE FROM BowlingInfo WHERE Id = :id");
    $this->db->bind("id", $id, PDO::PARAM_INT);
    return $this->db->execute();
  }

  public function createPerson($post)
  {
    $this->db->query("INSERT INTO BowlingInfo(Id, Voornaam, Tussenvoegsel, Achternaam, Roepnaam, IsVolwassen) 
                      VALUES(:id, :voornaam, :tussenvoegsel, :achternaam, :roepnaam, :isVolwassen)");

    $this->db->bind(':id', NULL, PDO::PARAM_INT);
    $this->db->bind(':voornaam', $post["voornaam"], PDO::PARAM_STR);
    $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"], PDO::PARAM_STR);
    $this->db->bind(':achternaam', $post["achternaam"], PDO::PARAM_STR);
    $this->db->bind(':roepnaam', $post["roepnaam"], PDO::PARAM_STR);
    $this->db->bind(':isVolwassen', $post["isVolwassen"], PDO::PARAM_BOOL);

    return $this->db->execute();
  }
}