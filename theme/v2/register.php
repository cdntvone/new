<?php require_once('include/data/host.php'); minify();?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="0;url=<?php echo config('URL_afliasi');?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo cdn();?>/images/favicon.ico">
        <title>Register</title>
        <style>
        .loading-redirect {
        height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        }
        .text-center {
        text-align: center!important;
        background: center no-repeat #fff;
        margin-top: -5em;
        }
        .lds-dual-ring {
        display: inline-block;
        width: 64px;
        height: 64px;
        padding-top: 1em;
        }
        .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 50px;
        height: 50px;
        margin: 1px;
        border-radius: 50%;
        border: 3px solid #000;
        border-color: #000 transparent #000 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
        0% {
        transform: rotate(0deg);
        }
        100% {
        transform: rotate(360deg);
        }
        }
        </style>
    </head>
    <body class="text-center loading-redirect">
        <div class="lds-dual-ring">
      </div><?php echo Histats() . Blocker();?>

    </body>
</html>