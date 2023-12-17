<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <style>

        .terms-container{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10%;
        }

    </style>
    <body>

    <div class="terms-container">
       
        <p><?php echo $_settings->info('terms')  ?>  </p>
    </div>  
        <script src="" async defer></script>
    </body>
</html>