<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">

        <title>Login - Election Campaign</title>

        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="UTF-8"></script>
<link href="https://fonts.googleapis.com/css?family=Lato|Merriweather+Sans|Montserrat|Noto+Sans|Raleway&display=swap" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <style>


                form{

                    padding: 0px;
                    border: none;


                }

    body {
        min-height: 100vh;
        background-image: linear-gradient(120deg, #3498db, #8e44ad);
    }
  * {
        margin: 0;
        padding: 0;
        text-decoration: none;
        font-family: 'Montserrat', sans-serif;
        box-sizing: border-box;
    }

    .login-form {
        width: 360px;
        background: #f1f1f1;
        height: 580px;
        padding: 80px 40px;
        border-radius: 10px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .login-form h1 {
        text-align: center;
        margin-bottom: 60px;
    }

    .txtb {
        border-bottom: 2px solid #adadad;
        position: relative;
        margin: 30px 0;
    }

    .txtb input {
        font-size: 15px;
        color: #333;
        border: none;
        width: 100%;
        outline: none;
        background: none;
        padding: 0 5px;
        height: 40px;
    }

    .txtb span::before{
        content: attr(data-placeholder);
        position: absolute;
        top: 50%;
        left: 5px;
        color: #adadad;
        transform: translateY(-50%);
        z-index: -1;
        transition: .5s;
    }

    .txtb span::after{
        content: '';
        position: absolute;
        width: 0%;
        height: 2px;
        left: 0;
        bottom: -2px;
        background: linear-gradient(120deg, #3498db, #8e44ad);
        transition: .5s;
    }

    .focus + span::before{
        top: -5px;
    }
    .focus + span::after{
        width: 100%;
    }

    .logbtn{
        display: block;
        width: 100%;
        height: 40px;
        border: none;
        background: linear-gradient(120deg,#3498db, #8e44ad, #3498db );
        background-size: 200%;
        color: #fff;
        outline: none;
        cursor: pointer;
        transition: .5s;
    }

    .logbtn:hover{
        background-position: right;
    }

    .bottom-text{
        margin-top: 50px;
        text-align: center;
        font-size: 13px;
    }
    
    .bottom-text a:hover{
        text-decoration: none;
    }
            </style>

        </div>


	<form id="add_volinter" action="auth/login" method="post" enctype="multipart/form-data" class="login-form">
        <h1>SignIn</h1>

        <div class="txtb">
		<?php if($phone!=''){ ?>
            <input type="text" name="identity" value="<?php echo $phone; ?>" required>
		<?php }else{ ?>
		<input type="text" name="identity" required>
		<span data-placeholder="Enter Email/Mobile"></span>
		<?php } ?>
        </div>
		<div class="txtb">
            <input type="password" name="password">
            <span data-placeholder="Enter Password"> <!--<a data-toggle="modal" href="#myModal" style="margin-top:-20px;float:right;"><span class="txtb">Forgot?</span></a>--></span>
        </div>

        <input type="submit" class="logbtn" value="CONTINUE">
		</br>
        <input type="submit" class="logbtn" value="Request for Otp?">
        <div class="bottom-text">
           Don't have an account ? <a href="<?php echo base_url()?>auth/register">SignUp </a>
        </div>

    </form>

        </div>






        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="auth/forgoten_password">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input class="btn btn-success" type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
 <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>

<script type="text/javascript">
        $(".txtb input").on("focus", function(){
            $(this).addClass("focus");
        });

        $(".txtb input").on("blur", function(){
            $(this).addClass("focus");
            if($(this).val() == "")
            $(this).removeClass("focus");
        });        
    </script>
    </body>
</html>
