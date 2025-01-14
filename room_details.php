<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myth Hotel - ROOM DETAILS</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <?php

    if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id` =? AND `status`=?", [$data['id'], 1], 'ii');
    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    ?>

    <!--    CARDS -->

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold"><?php echo $room_data['name']?></h2>
               <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
               </div>
            </div>


            <div class="col-lg-9 col-md-12 px-4">

               


            </div>



        </div>
    </div>

    <?php require('inc/footer.php'); ?>

</body>

</html>