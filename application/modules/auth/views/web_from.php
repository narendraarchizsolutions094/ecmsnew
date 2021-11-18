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
	
		<script src="common/js/jquery.js"></script>
    </head>
 <body class="login-body">

        <div class="container">

            <style>


                form{

                    padding: 0px;
                    border: none;


                }


            </style>
									<?php  $message2 = $this->session->flashdata('feedback1'); if (!empty($message2)) {?>
                                       
                                 
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
                                       
									<?php }
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
						
   <div class="modal fade in" id="myModal" tabindex="-1"  onclick="gethide()" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		   <button type="button"  style="float:right"  onclick="gethide()" data-dismiss="modal" id="myModal2">&times;</button>
        </div>
        <div class="modal-body">
          <p class="btn btn-success"> <?php echo $message; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-default" onclick="gethide()" data-dismiss="modal" id="myModal2">Close</button>
        </div>
      </div>
      
    </div>
  </div>						
                        
                    <?php } ?> 
							<?php 
                    $message = $this->session->flashdata('feedback3');
                    if (!empty($message)) {
                        ?>
						
   <div class="modal fade in" id="myModal" tabindex="-1"  onclick="gethide()" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		   <button type="button"  style="float:right"  onclick="gethide()" data-dismiss="modal" id="myModal2">&times;</button>
        </div>
        <div class="modal-body">
          <p class="btn btn-success"> <?php echo base64_decode($message); ?></p>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-default" onclick="gethide()" data-dismiss="modal" id="myModal2">Close</button>
        </div>
      </div>
      
    </div>
  </div>						
                        
                    <?php } ?> 
		
</div>
                                    <form role="form"  class="form-signin" id="add_volinter" action="auth/addNew" method="post" enctype="multipart/form-data">
                                    <h2 class="login form-signin-heading">Join With Us<br/><br/><img alt="" src="uploads/favicon.png"></h2>
                                    <!--<div id="infoMessage"><?php echo $message; ?></div>-->
                                    <div class="login-wrap"> 

                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" onblur="get_byid(this.value)"  class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('phone');
                                            }
                                            if (!empty($voter->phone)) {
                                                echo $voter->phone;
                                            }
                                            ?>' placeholder="Phone">
                                        </div>
                                        </div>

                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($voter->name)) {
                                                echo $voter->name;
                                            }
                                            ?>' placeholder="Name">
                                        </div>
                                        </div>
                                        										
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->email)) {
                                                echo $voter->email;
                                            }
                                            ?>' placeholder="Email">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">D.O.B</label>
                                            <input type="date" class="form-control" name="dob"  style="padding:none !imortant"id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->email)) {
                                                echo $voter->email;
                                            }
                                            ?>' placeholder="Password">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('ward_no'); ?></label>
                                            <select class="form-control m-bot15" name="wardno" >
<option value="">please select</option>											
                                                <?php foreach ($getword as $vot) { ?>
                                  <option value="<?php echo $vot->id; ?>"><?php echo $vot->w_name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        </div>
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Voter Id</label>
                                            <input type="text" class="form-control" name="Voterid" id="exampleInputEmail1" value='' placeholder="Voter Id">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age</label>
                                            <input type="text" class="form-control" onkeypress='validate(event)' maxlength="3" name="age"  placeholder="Age">
                                        </div>
                                        </div> 

                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('address');
                                            }
                                            if (!empty($voter->address)) {
                                                echo $voter->address;
                                            }
                                            ?>' placeholder="Address">
                                        </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($voter->sex)) {
                                                    if ($voter->sex == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Male </option>
                                                <option value="Female" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($voter->sex)) {
                                                    if ($voter->sex == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Female </option>
                                                <option value="Others" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Others') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($voter->sex)) {
                                                    if ($voter->sex == 'Others') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('others'); ?> </option>
                                            </select>
                                        </div>
                                        </div> 
                                         <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('marital_status'); ?></label></br>
                                          <label class="radio-inline">
											  <input checked type="radio" class="form-control" name="optradio" id="optradio1" onclick="unirveser_date('Unmarried')" value="Unmarried" <?php if($voter->marital_status=='Unmarried'){echo 'checked';} ?>>Unmarried
											</label>
											                                            <label class="radio-inline">
											  <input class="form-control" type="radio" name="optradio" id="optradio2"  value="Married"   onclick="unirveser_date('Married')">Married
											</label>
                                        </div>
                                        </div>
										 <div class="col-md-6" style="display:none;" id="Anniversary"> 
                                           <div class="form-group">
										    <label for="exampleInputEmail1">Anniversary Date</label>
                                            <input type="date" class="form-control"   name="Anniversary" id="Anniversary2"  placeholder="Anniversary">
                                            </div>
                                           </div>
                                       

                              
										  <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url" class="form-control">
											<br>
											<img src="" height="100px" width="100px"  id="img">
                                        </div>
                                        </div>
										 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Voter Id</label>
                                            <input type="file" name="voter_id" class="form-control">
											<br>
											<img src="" height="100px" width="100px"   id="voter_id">
                                        </div>
                                        </div>
										
                                        
                                           
                                             <button type="submit" name="submit" class="btn btn-lg btn-login btn-block"><?php echo lang('submit'); ?></button>
                                      
										
                                       
                                       
                                       <input type="hidden" class="form-control" value="<?php echo $id1; ?>" name="party_id" id="exampleInputEmail1" placeholder="">
                                          <input type="hidden" class="form-control" value="<?php echo $id2; ?>" name="user_id" id="exampleInputEmail1" placeholder="">
                                         
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($voter->id)) {
                                            echo $voter->id;
                                        }
                                        ?>'>
                                        <input type="hidden" name="p_id" value='<?php
                                        if (!empty($voter->voter_id)) {
                                            echo $voter->voter_id;
                                        }
                                        ?>'>
        
                                        <input type="hidden" class="form-control" name="password"  value='12345' placeholder="Password">
                                       
                                   
                                </div>
								 </form>
               </div>              
         </section>
<!--main content end-->
<!--footer start-->
        <!-- js placed at the end of the document so the pages load faster -->
        
<script src="common/js/common-scripts.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<!--script for this page only-->
<script src="common/js/editable-table.js"></script>
<script src="common/assets/fullcalendar/fullcalendar.js"></script>


<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
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
function get_byid(id) {
$.ajax({
    url: 'auth/editVolunteerByJason?id=' + id,
    method: 'GET',
    data: '',
    dataType: 'json',
   }).success(function (response) {
   $('#add_volinter').find('[name="name"]').val(response.volunteer.name);
   $('#add_volinter').find('[name="email"]').val(response.volunteer.email);
   $('#add_volinter').find('[name="age"]').val(response.volunteer.age);
   $('#add_volinter').find('[name="Voterid"]').val(response.volunteer.voter_id);
   $('#add_volinter').find('[name="address"]').val(response.volunteer.address);
    $('#add_volinter').find('[name="dob"]').val(response.volunteer.birthdate);
	$('#add_volinter option[value="'+response.volunteer.ward_no+'"]').attr("selected","selected");
	//$('#add_volinter option[value="'+response.volunteer.ward_no+'"]').attr("selected","selected");
	$('#add_volinter option[value="'+response.volunteer.sex+'"]').attr("selected","selected");
		if(response.volunteer.marital_status==='Married'){
       document.getElementById('Anniversary').style.display = 'Block';
	   $('#optradio2').prop( "checked", true );
	      $('#Anniversary2').val(response.volunteer.universary_date);
}else{
	document.getElementById('Anniversary').style.display = 'none';
	 $('#optradio1').prop( "checked", true );
}
       if (typeof response.volunteer.img_url !== 'undefined' && response.volunteer.img_url != '') {
                $("#img").attr("src", response.volunteer.img_url);
            }
if (typeof response.volunteer.voter_id_card !== 'undefined' && response.volunteer.voter_id_card != '') {
                $("#voter_id").attr("src", response.volunteer.voter_id_card);
            }			
  });
}

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