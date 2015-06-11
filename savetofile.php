<?php

$link = mysqli_connect('localhost', '', '', 'test');

$title = mysqli_real_escape_string($link, $_POST['title']);
$description = mysqli_real_escape_string($link, $_POST['description']);
$img = $_POST['myFile'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$filename = "uploads/" . uniqid() . '.png';
$success = file_put_contents($filename, $data);
if (!$success){
	echo 'Fail';
}
$query = "INSERT INTO imager (`image`,`title`,`description`) VALUES ('$filename','$title','$description')";
mysqli_query($link, $query);


//set image to interlaced for better downloading
$im = imagecreatefrompng($filename);
imageinterlace($im, true);
imagepng($im, $filename);
imagedestroy($im);

/*
if (isset($_FILES['myFile'])) {
    // Example:
    $file_destination = "uploads/" . $_FILES['myFile']['name'];
    move_uploaded_file($_FILES['myFile']['tmp_name'], $file_destination);
    $query = "INSERT INTO imager (`image`,`title`,`description`) VALUES ('$file_destination','$title','$description')";
	mysqli_query($link, $query);
    echo 'successful';
}
*/


function image_fix_orientation($image, $filename) {
    $exif = exif_read_data($filename);

    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
    }
}

?>