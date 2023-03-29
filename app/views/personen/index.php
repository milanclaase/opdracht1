<head>
    <link rel="stylesheet" type="text/css" href="../public/css/personen.css">
</head>
<row>
    <h1>Overzicht klanten</h1>
    <form method="post">
        <label for="date">DatumAangemaakt:</label>
        <select name="date" id="date">
            <option value="">Selecteer een datum</option>
            <?php foreach ($dates as $date) {
      echo "<option value=\"$date->DatumAangemaakt\">$date->DatumAangemaakt</option>";
    } ?>
        </select>
        <button type="submit">Tonen</button>
    </form>
</row>

<?php if (isset($data["persons"])) : ?>
<table>
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Mobiel</th>
            <th>Email</th>
            <th>Volwassen</th>
        </tr>
    </thead>
    <tbody>
        <?= $data["persons"] ?> </tbody>
</table>
<?php endif; ?>