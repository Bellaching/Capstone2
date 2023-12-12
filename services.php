<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
    </head>

    <style>
   body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .service-info {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 100px auto;
        width: 50%;
        margin-bottom: 200px;
    }

    .service-info h1 {
        font-size: 24px;
        margin: 5px 0;
    }

    .service-h1 {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        color: #fff;
        background-color: #004399;
        height: 200px;
        width: 100%;
    }

    .service-h1 h1 {
        margin-top: 3%;
    }

    .service-h1 p {
        margin: 1%;
    }





    .service_description p {
        text-align: center;
    }


    .service-info{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

 .service-img>img{
    width: 100% ;
 }

    .service-info1,
    .service-img{
        width: 50%;
        margin: 5%;
    }

    </style>

    <body class="Services">
   
    <!--Start-of-Sevices-------------------------------------------------------------------------------->
    <div class="service-container">
        <div class="service-h1">
        <h1> <?php echo $_settings->info('servicetitle') ?></h1>
        <p> <?php echo $_settings->info('servicep') ?></p>
        
        </div> 

        <div class="service-info">
           
            

                <div class="service-info1">
                    <h1> <?php echo $_settings->info('service_name') ?></h1>
                    <p><?php echo $_settings->info('service_description')  ?>  </p>
                </div>

                <div class="service-img">
                    <img src="<?php echo validate_image($_settings->info('service1')) ?>">    
                </div>

            

            

        </div>

        

    <!--End-of-Sevices--------------------------------------------------------------------------------> 
        
    </body>

    
</html>