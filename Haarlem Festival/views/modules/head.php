<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Group 5 Development">
<link href="css/nav.css" rel="stylesheet">
<?php
    switch($pageName)
    {  
        case 'home':
            ?>
            <link rel="stylesheet" href="css/homepage.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/homepage.css')) ?>">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src='views/javascript/homepage.js?$$REVISION$$'></script>
            <?php
        break;
        case 'jazz':
            ?>
            <link rel="stylesheet" href="css/jazz.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/jazz.css')) ?>">
            <link rel="stylesheet" href="css/carousel.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/carousel.css')) ?>"> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src='views/javascript/main.js?$$REVISION$$'></script>
            <script src='views/javascript/carousel.js?$$REVISION$$'></script>  
            <?php
        break;
        case 'dance':
            ?>
            <link rel="stylesheet" href="css/dance.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/dance.css')) ?>"> 
            <link rel="stylesheet" href="css/carousel.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/carousel.css')) ?>"> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src='views/javascript/main.js?$$REVISION$$'></script>
            <script src='views/javascript/carousel.js?$$REVISION$$'></script>       
            <?php
        break;
        case 'food':
            ?>
            <link rel="stylesheet" href="css/food.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/food.css')) ?>">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src='views/javascript/main.js?$$REVISION$$'></script>
            <?php
        break;
        case 'historic':
            ?>
            <link rel="stylesheet" href="css/historic.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/historic.css')) ?>">
            <link rel="stylesheet" href="css/carousel.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/carousel.css')) ?>"> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src='views/javascript/main.js?$$REVISION$$'></script>
            <script src='views/javascript/carousel.js?$$REVISION$$'></script>  
            <?php
        break;
        case 'tickets':
            ?>
            <link rel="stylesheet" href="css/tickets.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/tickets.css')) ?>">
            <?php
        break;
        case 'payment':
            ?>
            <link rel="stylesheet" href="css/payment.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/payment.css')) ?>">
            <?php
        break;
        case 'thankyou':
            ?>
            <link rel="stylesheet" href="css/payment.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/thankyou.css')) ?>">
            <?php
        break;
        default:
        break; 
    }

?>
<link rel="stylesheet" href="css/main.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/main.css')) ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<title><?php echo $title; ?></title>