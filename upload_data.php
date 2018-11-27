<?php

require "/media/minhduc0711/Libraries/Codes/usth/web_dev/vendor/autoload.php";

function convertDateFormat($date_str) {
    $date = date_create($date_str);
    return date_format($date, "d/m/y");
}

$client = Algolia\AlgoliaSearch\SearchClient::create(
    'MQ39V1L64H',
    '89090a11fec2dfe035ee55d52a4d1f7a'
);

$index = $client->initIndex("buy");
// Push the record onto Algolia
$response = $index->saveObject(
    [
        "title" => $_POST["title"],
        "description" => $_POST["description"],
        "expiration_date" => convertDateFormat($_POST["expirationDate"]),
        "category" => $_POST["housingType"],
        "img_link" => ""
    ],
    [
        "autoGenerateObjectIDIfNotExist" => true
    ]
);

// Save images to server
$response = (array) $response;
$newObjectId = $response["\0*\0apiResponse"][0]["objectIDs"][0];

$uploaded_images_dir = 'upload_images/' . $newObjectId;
mkdir($uploaded_images_dir);

echo '<pre>';

$img_paths = array();
$total_img_count = count($_FILES["images"]["name"]);
$success_count = 0;
foreach ($_FILES["images"]["error"] as $key => $error) {
    $tmp_name = $_FILES["images"]["tmp_name"][$key];
    $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
    $path_on_server = $uploaded_images_dir . "/" . $success_count . "." . $ext;
    $full_path = dirname(__FILE__) . "/" . $path_on_server;
    echo $full_path . "\n";
    if ($error == UPLOAD_ERR_OK) {
        if (move_uploaded_file($tmp_name, dirname(__FILE__) . "/" . $path_on_server)) {
            $success_count += 1;
            array_push($img_paths, $path_on_server);
        }
    }
}

echo "Succesfully uploaded " . $success_count . "/" . $total_img_count . " images\n";

print "</pre>";

$index->partialUpdateObject(
    [
      'img_link' => $img_paths,
      'objectID' => $newObjectId
    ]
);

?>
