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
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />

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
    form-signin .form-control {
     padding-top: -10px !mportant;}

            </style>

                 <form role="form" class="form-signin"  id="add_volinter" action="auth/verify_otp" method="post" enctype="multipart/form-data" style="width:300px;">
                <h2 class="login form-signin-heading">Verify Otp<br/><br/><img alt="" src="uploads/favicon.png"></h2>
				 <?php   $message2 = $this->session->flashdata('feedback'); if (!empty($message2)) {?>
                                       
                                 
<div class="modal fade in" id="myModal" tabindex="-1"  onclick="gethide()" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		   <button type="button"  style="float:right" onclick="gethide()" data-dismiss="modal" id="myModal2">X</button>
         
        </div>
        <div class="modal-body">
          <div class="col-lg-12 btn btn-success"><?php echo $message2; ?> </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-default" onclick="gethide()" data-dismiss="modal" id="myModal2">Close</button>
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
        <div class="modal-header">
		   <button type="button"  style="float:right" onclick="gethide()" data-dismiss="modal" id="myModal2">X</button>
         
        </div>
        <div class="modal-body">
          <div class="col-lg-12 btn btn-danger"><?php echo $message2; ?> </div>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-default" onclick="gethide()" data-dismiss="modal" id="myModal2">Close</button>
        </div>
      </div>
      
    </div>
  </div>
                                       
									<?php }?>
				
                                      <div class="login-wrap" >  
				                           <div class="col-md-12">
                                           <div class="form-group">
				                           <input type="text"   class="form-control"  name="otp" maxlength='6' value='' placeholder="Enter Otp">
										    <input type="hidden"   class="form-control"  name="phone"  value='<?php echo $phone; ?>' placeholder="otp">
											 <input type="hidden"   class="form-control"  name="data1"  value='<?php echo $from1; ?>' placeholder="otp">
											  <input type="hidden"   class="form-control"  name="data2"  value='<?php echo $from2; ?>' placeholder="otp">  
											  <input type="hidden"   class="form-control"  name="password"  value='<?php echo $password; ?>' placeholder="otp">
                                           </div>
                                           </div>
                                      <button type="submit" name="submit"  class="btn btn-lg btn-login btn-block"><?php echo lang('submit'); ?></button>
								
								</div>
                                </form>


         

        </div>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>
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


    </body>
</html>
