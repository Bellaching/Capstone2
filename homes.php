<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
    
    <style>

        .body{
            background-color: #ffff;
        }
        .banner_fw_container {
            height: 80vh;
            display: flex;
    justify-content: flex-start;
    align-items: center;
        }
        #banner-fw {
    background-image: url('<?php echo validate_image($_settings->info('cover')) ?>');
    background-size: cover;
    height: 90vh;
    position: relative;
    background-color: #1A547E;
}

.banner_fw {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(0 0 0 / 30%);
}
        .banner_content{
            color:white;
            max-width: 600px; /* Adjust the maximum width based on your design */
    margin-right: auto; /* Push the content to the left */
    
        }
        .banner_content span {
            color:white;
            font-size: 30px;
        }
        .banner_content h1 {
            font-size: 65px;
        }
        button.shop-now-fw {
            padding: 15px 60px;
            background: none;
            box-shadow: none !important;
            border: 1px solid white;
            color:white;
            font-family: 'Montserrat', sans-serif;
            margin-top: 80px;
        }

       

        

        button.shop-now-fw:hover{
            color:white;
            background-color: #004399;
            border: none;
        }


        
        .container.products_home_content {
            padding: 60px 0px;
        }
        .image_container_best_seller img {
            width: 100%;
        }
        .header_product_home {
            align-items: flex-start;
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
        }
        .header_product_home_ctn{
            padding:50px;
        }
        .header_product_home_ctn a {
            background: #0d6efd;
            color: white;
            padding: 15px 60px;
            border-radius: 41px;
        }
        .product_tn_home {
            margin-top: 45px;
        }
        .header_product_home_ctn span {
            color: #0d6efd;
            font-weight: 700;
            font-size: 24px;
        }
        section.new_arrivals h1 {
    margin-bottom: 30px;
    padding-bottom: 30px;
    text-align: center;
    font-size: 1.5rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 600;
    margin-top: 40px;
    padding: 5px 30px;
    border: 1px solid #e0e0e0;
    width: 20%; /* Adjust the width as needed */
    color: #ffffff;
    background-color: #202020;
    margin-left: auto;
    margin-right: auto;
}

section.new_arrivals {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.feature-heading{
  display: flex;
  justify-content: center;
  align-items: center;

}
/*----Mark---------------*/
.feature-heading h2{
  font-size: 1.5rem;
  color: #1b1919;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-weight: 600;
  margin-top: 40px;
  padding: 15px 45px;
  border: 1px solid #e0e0e0;

}

.feature-box {
  width: 155px;
  height: 155px;
  margin: 0px 20px;
  border-radius: 10px;
  overflow: hidden;
}

.feature-box a img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.item{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

  .row{
            margin: 4%;
            display: flex;
            flex-direction: row;
            
        }

        #brand_list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card-item{
    border: none;

}

.card-item:hover{
    box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.8);
    


    
}

.card{
    box-shadow: 0px -7px 12px -4px rgba(0,0,0,0.51);
-webkit-box-shadow: 0px -7px 12px -4px rgba(0,0,0,0.51);
-moz-box-shadow: 0px -7px 12px -4px rgba(0,0,0,0.51);
}
.product-container1{
    width: 200px;
}

.product_archive{
     margin: 0 10px 15px;
}

.brand-item {
    width: 200px; /* Adjust the width of each brand item as needed */
    margin: 0 10px 15px;
   
    
}

.brand-img-holder {
    overflow: hidden;
    position: relative;
    border-radius: 10px;
    

    width: 100%; /* Ensure the container takes the full width of its parent */
}

.brand-img-holder img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the entire image is covered, maintaining aspect ratio */
    display: block;
    border-radius: 10px;
}

        .button_bottom_home a {
            background: #0d6efd;
            color: white;
            padding: 15px 60px;
            border-radius: 41px;
        }
        .button_bottom_home {
            text-align: center;
            margin-top: 60px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .new_arrivals{
            background-color: #ffff;
        }

      
        .slick-prev:before, .slick-next:before { 
          background-color: white;
          color:#004399 !important;
        }

        .slick-prev, .slick-next {           
           margin:1%;
        }

        .slick-slide {
    width: 200px; !important;
  }

  .slick-slide img {
    width: 100%; /* Ensure images within the slides are responsive */
    height: auto;
  }




        /* Styles for large screens */
        @media (min-width: 992px) {
            
            .banner_fw_container {
             height: 80vh;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 80vh;
            
            }

            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 65px;
            }
            .banner_content p {
                font-size: 20px;
            }
        }

        /* Styles for medium screens */
        @media (max-width: 991px) {
                  .banner_fw_container {
             height: 80vh;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 60vh;
            
            }
            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                align-items: center;
            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 50px;
                overflow-wrap: break-word;
            }
            .banner_content p {
                font-size: 18px;
                overflow-wrap: break-word;
            }
        }

        /* Styles for small screens */
        @media (max-width: 667px) {

            #banner-fw {
        height: 80vh; /* Adjust the height for smaller screens */
    }

            .banner_fw_container {
             height: 80vh;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 40vh;
             text-align:center;
            }
            .banner_fw .banner_fw_container {
                height: 100%;
            }
            .header_product_home {
                align-items: center;
                justify-content: center;
            }
            .button_bottom_home {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .banner_content h1 {
                font-size: 40px;
                overflow-wrap: break-word;
            }
            .banner_content p {
                font-size: 16px;
                overflow-wrap: break-word;
            }
        }

    </style>
</head>
<body>
    <section id="banner-fw" >
        <div class="banner_fw">
            <div class="banner_fw_container container d-flex align-items-center">
                <div class="banner_content">
                   
                    <h1><?php echo $_settings->info('homename1') ?></h1>
                    <p><?php echo $_settings->info('homedes1')  ?> </p>
                   <button class="shop-now-fw" onclick="window.location.href='./?p=products'">Shop now</button>

                </div>
            </div>
        </div>
    </section>

    
    <section>
        <div class="container_brand">
        <div class="feature-heading">
       <h2>Featured Brands</h2>
     </div>

     <div class="row responsive" id="brand_list" >
    <?php 
    $brands = $conn->query("SELECT * FROM `brand_list` where status = 1 and delete_flag = 0 order by `name`");
    while($row = $brands->fetch_assoc()):
    ?>
    <div class=" brand-item">
        <div class="card ">
            <div class="brand-img-holder overflow-hidden position-relative">
                <img src="<?= validate_image($row['image_path']) ?>" alt="Brand Image" class="img-top">
            </div>
            
        </div>
    </div>
    <?php endwhile; ?>
</div>

<section>

    <section class="new_arrivals py-5">
        <div class="container">
            <h1 class="new-arrivals-ctn">New Arrivals</h1>
            <div class="row responsive-arrivals">
                <?php
                $products = $conn->query("SELECT p.*, b.name as brand, c.category FROM `product_list` p INNER JOIN brand_list b ON p.brand_id = b.id INNER JOIN `categories` c ON p.category_id = c.id WHERE p.delete_flag = 0 AND p.status = 1 LIMIT 6");
                // Counter variable to keep track of displayed products
                $counter = 0;
                while ($row = $products->fetch_assoc()) :
                    // Increment the counter
                    $counter++;
                    // Display your product information here
                ?>  
                    <div class="col-md-4 product_archive">
                        <a class="product-container1" href="./?p=products/view_product&id=<?= $row['id'] ?>">
                            <div class="card-item">
                                <div class="product-img-holder">
                                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top" style="width: 100%; height: 250px; display: flex; justify-content: center; align-items: center; object-fit:cover;" />
                                </div>
                                <div class="card-body border-top">
                                    <div class="card-title my-0">
                                        <span><?= $row['name'] ?></span>
                                    </div>
                                    <p class="price">₱<?= strip_tags(html_entity_decode($row['price'])) ?>
                                        <span class="fas fa-tag"></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                <?php
                    // Check if we have displayed 4 products, and break out of the loop if true
                    if ($counter >= 6) {
                        break;
                    }
                endwhile;
                ?>
               
            </div>
            <div class="button_bottom_home">
                    <a href="./?p=products/">Shop Now</a>
                </div>
        </div>
    </section>

    
    <section id="products-home-fw" >
        <div class="products_home_fw">
            <div class="container products_home_content">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="header_product_home">
                            <?php
                            $products = $conn->query("SELECT p.*, b.name AS brand, c.category, COUNT(o.product_id) AS order_count
                                FROM product_list p
                                INNER JOIN brand_list b ON p.brand_id = b.id
                                INNER JOIN categories c ON p.category_id = c.id
                                INNER JOIN order_items o ON o.product_id = p.id
                                WHERE p.delete_flag = 0 
                                AND p.status = 1 
                                GROUP BY p.id
                                ORDER BY order_count DESC
                                LIMIT 1;");
                            // Counter variable to keep track of displayed products
                            $counter = 0;
                            while ($row = $products->fetch_assoc()) :
                                // Increment the counter
                                $counter++;
                                // Display your product information here
                            ?>
                            <div class="image_container_best_seller">
                                <img src="<?= validate_image($row['image_path']) ?>" alt="Product Image" class="img-top"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 header_product_home">
                        <div class="header_product_home_ctn">
                            <span>Best Seller</span>
                            <h2><?= $row['name'] ?></h2>
                            <p> <?= isset($description) ? html_entity_decode($description) : '' ?></p>
                            <div class="product_tn_home">
                                <a href="./?p=products/view_product&id=<?= $row['id'] ?>">View Product</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <?php
                    // Check if we have displayed 4 products, and break out of the loop if true
                    if ($counter >= 4) {
                        break;
                        }
                    endwhile;
                ?>
            </div>
        </div>
    </section>

    <section>
    <div class="product-review responsive-review">
            <?php
            $productReviews = $conn->query(
                "SELECT pr.author_rate, pr.author_comment FROM `product_reviews` pr
                    inner join `product_variations` pv on pr.variation_id = pv.id
                where pr.product_id =  $id order by unix_timestamp(pr.date_created) desc;
                "
            );
            while ($review = $productReviews->fetch_assoc()) :
            ?>
                <div class="review-section mb-3 border rounded p-3">
                    <figure class="mb-1">
                        <blockquote class="blockquote">
                            <p><?= ucfirst($review['author_name']) ?></p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-1">
                            <?= date("Y-m-d h:i:s A", strtotime($review['date_created'])) ?> | Variation: <?= $review['variation_name'] ?>
                        </figcaption>
                    </figure>
                    <div class="review-details">
                        <?php switch (strval($review['author_rate'])):
                            case "1": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "2": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "3": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "4": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star-o"></i>
                            <?php break;
                            case "5": ?>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            <?php break;
                            default: ?>
                        <?php endswitch; ?>
                        <p class="reviewer-comments mt-3"><?= ucfirst($review['author_comment']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
</div>

<section>

    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
 $('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 1,
  responsive: [
    {
        
        breakpoint: 1000,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true,
          variableWidth: true
        }
      },
    {
        
        breakpoint: 900,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true
          
        }
      },
    {
        
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true,
        arrows:true
        
      }
    },


    {
      breakpoint: 300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
       

      }
    },
    {
      breakpoint: 180,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
        
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.responsive-review').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
        
        breakpoint: 1000,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true,
          variableWidth: true
        }
      },
    {
        
        breakpoint: 900,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true
          
        }
      },
    {
        
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 3,
        infinite: true,
        dots: true,
        arrows:true
        
      }
    },


    {
      breakpoint: 300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
       

      }
    },
    {
      breakpoint: 180,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
        
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.responsive-arrivals').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
        
        breakpoint: 1000,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true,
          variableWidth: true
        }
      },
    {
        
        breakpoint: 900,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
          arrows:true
          
        }
      },
    {
        
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true,
        arrows:true
        
      }
    },


    {
      breakpoint: 300,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
       

      }
    },
    {
      breakpoint: 180,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
        
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
</html>