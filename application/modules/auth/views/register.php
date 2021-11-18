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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="UTF-8"></script>
<link href="https://fonts.googleapis.com/css?family=Lato|Merriweather+Sans|Montserrat|Noto+Sans|Raleway&display=swap" rel="stylesheet">
    </head>

    <body class="login-body">
	
	
	
	<?php   $message2 = $this->session->flashdata('feedback'); if (!empty($message2)) {?>
                                       
                                 
<div class="modal fade in" id="myModal" tabindex="-1"  onclick="gethide()" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="col-lg-12 btn btn-success" style="text-align:center;color:#fff;margin-top:40px;"><?php echo $message2; ?> &nbsp;&nbsp;&nbsp;&nbsp; <button type="button"  style="" onclick="gethide()" data-dismiss="modal" id="myModal2">X</button></div>
        </div>
      </div>
      
    </div>
  </div>
                                       
									<?php }?>
                <?php   $message2 = $this->session->flashdata('feedback1'); if (!empty($message2)) {?>
                                       
                                 
						 <div class="modal fade in" id="myModal" tabindex="-1"  onclick="gethide()" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
          <div class="col-lg-12 btn btn-danger" style="text-align:center;color:#fff;margin-top:40px;"><?php echo $message2; ?> &nbsp;&nbsp;&nbsp;&nbsp; <button type="button"  style="" onclick="gethide()" data-dismiss="modal" id="myModal2">X</button></div>
        </div>
      </div>
      
    </div>
  </div>
                                       
									<?php }?>
									
									
									
									
        <div class="container">
<style>
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
<form id="add_volinter" action="auth/signupNewuser" method="post" enctype="multipart/form-data" class="login-form">
        <h1>Signup</h1>

        <div class="txtb">
            <input type="text" name="phone">
            <span data-placeholder="Enter Mobile"></span>
        </div>

        <input type="submit" class="logbtn" value="CONTINUE">

        <div class="bottom-text">

            Already have an account? <a href="<?php echo base_url()?>auth/login"> Sign In </a>

        </div>

    </form> 

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
  		<script>
function gethide() {
document.getElementById('myModal').style.display = 'none';
}
function unirveser_date(id) {
	if(id==='Married'){
document.getElementById('Anniversary').style.display = 'Block';
}else{
	document.getElementById('Anniversary').style.display = 'none';
}}

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>         

        </div>

    </body>
</html>
