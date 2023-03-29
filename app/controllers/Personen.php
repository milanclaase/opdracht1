<?php
class Personen extends Controller
{
  // Properties, field
  private $persoonModel;

  // Dit is de constructor
  public function __construct()
  {
    $this->persoonModel = $this->model('Persoon');
  }
    
  public function show()
  {
    $dates = $this->persoonModel->getDistinctDates();
    $data = [
      'title' => '<h1>Personenoverzicht</h1>',
      'dates' => $dates
    ];
  }

  public function index()
  {
    /**
     * Haal via de method getPersons() uit de model Persoon de records op
     * uit de database
     */
    $persons = $this->persoonModel->getPersons();


    /**
     * Maak de inhoud voor de tbody in de view
     */

    $rows = '';
    foreach ($persons as $value) {
      $rows .= "<tr>
                     <td>$value->Voornaam</td>
                     <td>$value->Tussenvoegsel</td>
                     <td>$value->Achternaam</td>
                     <td>" . (($value->Mobiel) ? $value->Mobiel : 'NULL') . "</td>
                     <td>" . (($value->Email) ? $value->Email : 'NULL') . "</td>
                     <td>" . (($value->IsVolwassen) ? 'Ja' : 'Nee') . "</td>
                   </tr>";
    }


    $data = [
      'title' => '<h1>Personenoverzicht</h1>',
      'persons' => $rows
    ];
    $this->view('personen/index', $data);
  }

  public function update($id = null)
  {
    // var_dump($id);exit();
    // var_dump($_SERVER);exit();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $this->persoonModel->updatePerson($_POST);
      header("Location:" . URLROOT . "/personen/index");
    } else {
      $row = $this->persoonModel->getSinglePerson($id);
      $data = [
        'title' => '<h1>Update personenoverzicht</h1>',
        'row' => $row
      ];
      $this->view("personen/update", $data);
    }
  }

  public function delete($id)
  {
    $this->persoonModel->deletePerson($id);

    $data = [
      'deleteStatus' => "Het record met id = $id is verwijdert"
    ];
    $this->view("personen/delete", $data);
    header("Refresh:3; url=" . URLROOT . "/personen/index");
  }

  public function create()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // var_dump($_POST);
      try {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->persoonModel->createPerson($_POST);
        header("Location:" . URLROOT . "/personen/index");
      } catch (PDOException $e) {
        echo "Het inserten van het record is niet gelukt";
        header("Refresh:3; url=" . URLROOT . "/personen/index");
      }
    } else {
      $data = [
        'title' => "Voeg een nieuwe persoon toe"
      ];

      $this->view("personen/create", $data);
    }
  }

  public function scanPerson()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $record = $this->persoonModel->getSinglePersonByLastName($_POST["lastname"]);

      $rowData = "<tr>
                    <td>$record->Id</td>
                    <td>$record->Voornaam</td>
                    <td>$record->Tussenvoegsel</td>
                    <td>$record->Achternaam</td>
                    <td>$record->Roepnaam</td>
                    <td>" . (($record->IsVolwassen) ? 'Ja' : 'Nee') . "</td>
                  </tr>";

      $data = [
        'title' => 'Dit is de gescande persoon',
        'rowData' => $rowData
      ];

      $this->view('personen/scanPerson', $data);
    } else {
      $data = [
        'title' => 'Scan de persoon',
        'rowData' => ""
      ];

      $this->view('personen/scanPerson', $data);
    }
  }
}