<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myth Hotel - HOME</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <?php require('inc/links.php'); ?>
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <!--Carousel-->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/carousel/1.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/2.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/3.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/4.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/5.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/6.png" class="w-100 d-block">
                </div>
            </div>
        </div>
    </div>

    <!--check availability form-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Our Rooms-->


    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">

        <?php
            
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? ORDER BY `id` DESC LIMIT 3",[1],'i');
            while($room_data =mysqli_fetch_assoc($room_res))
            {
                $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                WHERE rfea.room_id = '$room_data[id]'");

                $features_data = "";
                while($fea_row = mysqli_fetch_assoc($fea_q)){
                    $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>
                    $fea_row[name]
                </span>";
                }

               $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f
               INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
               WHERE rfac.room_id = '$room_data[id]'");

               $facilities_data = "";
               while($fac_row = mysqli_fetch_assoc($fac_q)){
                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>
                $fac_row[name]
            </span>";
            }

         

            
                $login=0;
                if(isset($_SESSION['login']) && $_SESSION['login']==true){
                    $login=1;
                }

                $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</a>";
            

            echo<<<data

                        <div class="col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                            <img src="images/Rooms/main.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5>$room_data[name]</h5>
                                <h5 class="mb-4">৳$room_data[price] per night</h5>
                                <div class="featured mb-4">
                                    <h6 class="mb_1">Features</h6>
                                    $features_data
                                </div>
                                <div class="facilities mb-4">
                                    <h6 class="mb_1">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="guests mb-4">
                                    <h6 class="mb_1">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $room_data[adult] Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $room_data[children] Children
                                    </span>
                                </div>
                                <div class="rating mb-4">
                                    <h6 class="mb_1">Rating</h6>
                                    <span class="badge rounded-pill bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-evenly mb-2">
                                $book_btn
                                   
                                </div>
                            </div>
                        </div>
                    </div>


            data;

            }
         ?>

          

            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms>>></a>
            </div>
        </div>
    </div>

    <!-- Our Facilities-->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            
         <?php
            $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY id DESC LIMIT 5");
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                 <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="$path$row[icon]" width="60px">
                    <h5 class="mt-3">$row[name]</h5>
                </div>
               
                data;
            }

        ?>
           
         
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities>>></a>

            </div>
        </div>
    </div>

    <!-- Testimonial -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/facilities/star.svg" width="30px">
                        <h6 class="m-0 ms-2">Random user-1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Cumque odit voluptatum praesentium. Fugiat minima cumque
                        id, nulla totam minus voluptate.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/facilities/star.svg" width="30px">
                        <h6 class="m-0 ms-2">Random user-1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Cumque odit voluptatum praesentium. Fugiat minima cumque
                        id, nulla totam minus voluptate.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/facilities/star.svg" width="30px">
                        <h6 class="m-0 ms-2">Random user-1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Cumque odit voluptatum praesentium. Fugiat minima cumque
                        id, nulla totam minus voluptate.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="collg-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More>>></a>
        </div>
    </div>

    <!-- Reach Us -->
    
    
   


    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img class="w-80" height="375px" src="images/map/syl.jpg">
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1']?>
                    </a>
                    <br>
                    <?php
                        if($contact_r['pn2']!=''){
                            echo<<<data
                            <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill"></i>+$contact_r[pn2]
                            </a>
                            data;
                        }
                    ?>
                    
                </div>
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>Follow us</h5>
                    <?php
                        if($contact_r['tw']!=''){
                            echo<<<data
                            <a href="$contact_r[tw]" class="d-inline-block mb-3">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-twitter me-1"></i>Twitter
                                </span>
                            </a>
                            <br>
                            data;
                        }
                    ?>
                    
                    <a href="<?php echo $contact_r['fb']?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['insta']?>" class="d-inline-block ">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram"></i> Instagram
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>



    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>

</body>

</html>