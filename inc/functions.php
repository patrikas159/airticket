<?php
function validate($data){
    global $validation;

    if ($_POST["flightNumber"] == "Pasirinkite skrydžio numerį" || !preg_match('/./', $_POST["flightNumber"])) {
        $validation[] = 'Nepasirinkote skrydžio numerio';
    }

    if (!preg_match('/\d{11}/', $_POST['idName'])) {
        $validation[] = 'Blogai įvestas arba neįvestas asmens kodas';
    }

    if (!preg_match('/[A-Z]./', $_POST['name'])) {
        $validation[] = 'Neįvedete vardo';
    }
    if (!preg_match('/[A-Z]./', $_POST['lastname'])) {
        $validation[] = 'Neįvedete pavardės';
    }

    if ($_POST["departure"] == "Pasirinkite miestą" || !preg_match('/./', $_POST["departure"])) {
        $validation[] = 'Nepasirinkote iš kur skrendate';
    }

    if ($_POST["arrival"] == "Pasirinkite miestą" || !preg_match('/./', $_POST["arrival"])) {
        $validation[] = 'Nepasirinkote į kur skrendate';
    }


    if (!preg_match('/\d{1,5}/', $_POST['price'])) {
        $validation[] = 'Blogai įvesta arba neįvesta kaina';
    }

    if ($_POST["bag"] == "Pasirinkite bagažo svorį" || !preg_match('/./', $_POST["bag"])) {
        $validation[] = 'Nepasirinkote bagažo svorio';
    } else if ($_POST["bag"] >= 20 || $_POST["bag"] == 25 || $_POST["bag"] == 30) {
        $_POST['price'] += 30;
    }

    if (!preg_match('/^\w{1,200}$/', $_POST['message'])) {
        $validation[] = 'Neįvedėte žinutės arba viršijote simbolių kiekį';
    }

    return $validation;
};


function printing(){

    $data = 'data/zinutes.txt';
    $content = file_get_contents($data);
    $formData = implode(',',$_POST);
    $content .= $formData."/n";
    file_put_contents($data, $content);

    $messages = file_get_contents('data/zinutes.txt', true);


};
function table()
{
    $messages = file_get_contents('data/zinutes.txt', true);
    $messages = explode('/n', $messages);
    echo "<table class='table table-dark bg-secondary table-hover' ><tr> ";
    echo "<th>Skrydžio numeris</th> <th>Departure</th> <th>Arrival</th> <th>Siūloma kaina</th> <th>Asmens kodas</th>
<th>Vardas</th> <th>Pavarde</th> <th>Bagažas</th> <th>Pastabos</th>
</tr>";
    foreach ($messages as $message) {
        echo '<tr>';
        $mess = explode(',', $message);


        foreach ($mess as $ttt) {
            if ($ttt != "") {

                echo "<td>$ttt</td>";
            }
        }
    }
    echo "</tr></table> ";
}
?>