<?php 
//connection a la base de données

if (!empty($_FILES['picture'])) {
    $files = $_FILES['picture'];
    $uploaded=array();
    $failed=array();
    $allowed=array('jpg','jpeg','png');
    foreach($files['name'] as $position => $file_name) {
        $files_tmp=$files['tmp_name'][$position];
        $files_size=$files['size'][$position];
        $file_error=$files['error'][$position];
        $file_ext=explode('.',$file_name);
        $file_ext=strtolower(end($file_ext));
        $formatTable=['jpg','jpeg','png','webp'];
        if(in_array($file_ext,$formatTable)){
            if($files_size<=1000000){
                //on crée un nom unique pour chaque image avec la fonction uniqid
                $file_new_name=uniqid('',true).'.'.$file_ext;
                $file_destination='uploads/'.$file_new_name;
        
                if(move_uploaded_file($files_tmp,$file_destination)){
                    $uploaded[$position]=$file_destination;
                }
            }
        }
    }
} else {
    echo "No file uploaded.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>formulaire</title>
</head>
<body>
    <form  method="post" enctype="multipart/form-data">

    <input type="file" name="picture[]" multiple id="">
    <input type="submit" value="upload">


    </form>

    <div class="container">
    <?php
    if(!empty($uploaded[$position])){ foreach($uploaded as $upload): ?>
        <img width="150px" height="140px" src="<?php echo $upload; ?>" alt="">
    <?php endforeach;} ?>
</div>

</html>