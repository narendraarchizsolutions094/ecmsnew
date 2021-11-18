<section id="main-content">
    <section class="wrapper site-min-height">
<div class="container">

            <style>


                form{

                    padding: 0px;
                    border: none;


                }


            </style>
			
		
</div>
                                    <form role="form"  class="form-signin" id="add_volinter" action="profile/addNew" method="post" enctype="multipart/form-data">
                                    <h2 class="login form-signin-heading">Profile<br/>   <label for="exampleInputEmail1">Position</label>
                                                <?php 
												$explode_position=explode(',',$voter->team_positon_id);
												//print_r($explode_position);
												if(!empty($voter->team_positon_id)){
												foreach ($explode_position as $pos){
                                                   echo $this->db->get_where('tbl_position', array('id' => $pos))->row()->degination.' ';
												}}else{echo '<br>N/A';} ?></h2>
                                    <div class="login-wrap"> 
                                    
                                       <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" onblur="get_byid(this.value)"  class="form-control" name="phone" id="exampleInputEmail1" value='<?php if (!empty($voter->vphone)) {
                                                echo $voter->vphone;
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
                                            <label for="exampleInputEmail1">Password</label>
                                               <input type="password" class="form-control" name="password"  value='12345' placeholder="Password">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">D.O.B</label>
                                            <input type="date" class="form-control" name="dob"  style="padding:none !imortant"id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->birthdate)) {
                                                echo $voter->birthdate;
                                            }
                                            ?>' placeholder="Password">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('ward_no'); ?></label>
                                            <select class="form-control m-bot15" name="wardno" >
<option value="">please select</option>											
                                                <?php foreach ($all_ward as $vot) { ?>
                                  <option value="<?php echo $vot->id; ?>"><?php echo $vot->w_name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        </div>
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Voter Id</label>
                                            <input type="text" class="form-control" name="Voterid" id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->voter_id)) {
                                                echo $voter->voter_id;
                                            }
                                            ?>' placeholder="Voter Id">
                                        </div>
                                        </div> 
										<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age</label>
                                            <input type="text" class="form-control" onkeypress='validate(event)' maxlength="3" name="age"  value='<?php
                                            if (!empty($voter->age)) {
                                                echo $voter->age;
                                            }
                                            ?>' placeholder="Age">
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
                                         <div class="col-md-12">
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
											<img src="<?php echo base_url().$voter->img_url;?>" height="100px" width="100px"  id="img">
                                        </div>
                                        </div>
										 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Voter Id</label>
                                            <input type="file" name="voter_id" class="form-control">
											<br>
											<img src="<?php echo base_url().$voter->voter_id_card;?>" height="100px" width="100px"   id="voter_id">
                                        </div>
                                        </div>
										
                                        
                                           
                                             <button type="submit" name="submit" class="btn btn-lg btn-login btn-block"><?php echo lang('submit'); ?></button>
                                      
										
                                       
                                       
                                       <input type="hidden" class="form-control" value="<?php echo $voter->ion_user_id;?>" name="party_id" id="exampleInputEmail1" placeholder="">
                                          <input type="hidden" class="form-control" value="<?php echo $voter->party_id;?>" name="user_id" id="exampleInputEmail1" placeholder="">
                                         
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
        
                                    
                                       
                                   
                                </div>
								 </form>
               </div>              
         </section>
  </section>
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
  </script>