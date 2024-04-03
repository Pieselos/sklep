<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form type="">
        <input name="data1" type="date">
        <input name="data2" type="date">
        <input type="submit">
    </form>

    <form action="" method="post" enctype="multipart/form-data"></form>
    <?php
    
        if(isset($_GET["data1"])){
            echo mb_strtolower("ŻÓŁTy");
        }

      
    ?>
</body>
</html>