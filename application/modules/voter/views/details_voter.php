<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
<?php if($this->uri->segment(3)!=''){ ?>
        <section class="panel">
            <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <?php
                if (!empty($voter->id))
                    echo 'Voter Details';
                else
                    echo lang('add_new_voter');
                ?>
            </header>

            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    
                                    <form role="form" action="voter/addNew" method="post" enctype="multipart/form-data">


<div class="col-lg-12">
                                        <div class="col-lg-6">
                                         <img src="<?php echo $patient->img_url ?>" alt="" height="100px" width="100px">
                                        </div>
                                         <div class="col-lg-6">
                                        <div class="form-group">
                                            <br>
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        
                                    </div>
<div class="col-lg-12">
                                        <div class="col-lg-6">
                                         <img src="<?php echo $patient->img_url1 ?>" alt="" height="100px" width="100px">
                                        </div>
                                         <div class="col-lg-6">
                                        <div class="form-group">
                                            <br>
                                            <label for="exampleInputEmail1"><?php echo lang('image_id'); ?></label>
                                            <input type="file" name="img_url1">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        
                                    </div>

                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($voter->name)) {
                                                echo $voter->name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->email)) {
                                                echo $voter->email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
										<div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                                            <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('age');
                                            }
                                            if (!empty($voter->age)) {
                                                echo $voter->age;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_id'); ?></label>
                                            <input type="text" class="form-control" name="voter_id" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('voter_id');
                                            }
                                            if (!empty($voter->voter_id)) {
                                                echo $voter->voter_id;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-group">        
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="" required>
                                        </div>
                                        </div>  
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                                            <select class="form-control m-bot15" name="category" value=''> 
                                                <?php foreach ($categorys as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php if($category->category==$voter->category){echo 'selected';} ?>><?php echo $category->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                                            <select class="form-control m-bot15" name="contacted" value=''>
                                               
                                                <?php foreach ($Dispostion as $dis) { ?>
                                                    <option value="<?php echo $dis->dispostion_id; ?>" <?php if($dis->dispostion_id==$voter->contacted){echo 'selected';} ?>><?php echo $dis->dispostion_title; ?> </option>
                                                <?php } ?>
                                           
                                            </select>
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('address');
                                            }
                                            if (!empty($voter->address)) {
                                                echo $voter->address;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('phone');
                                            }
                                            if (!empty($voter->phone)) {
                                                echo $voter->phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male"  <?php if($voter->sex=='Male'){echo 'selected';} ?>> Male </option>
                                                <option value="Female"  <?php if($voter->sex=='Female'){echo 'selected';} ?>> Female </option>
                                                <option value="Others"  <?php if($voter->sex=='Others'){echo 'selected';} ?>> <?php echo lang('others'); ?> </option>
                                            </select>
                                        </div>
                                        </div> 
                                      
                                        <div class="col-lg-6">

                                        <div class="form-group">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                                            if (!empty($setval)) {
                                                echo set_value('birthdate');
                                            }
                                            if (!empty($voter->birthdate)) {
                                                echo $voter->birthdate;
                                            }
                                            ?>" placeholder="">      
                                        </div>
                                        </div> 
										 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('ward_no'); ?></label>
                                            <select class="form-control m-bot15" name="wardno" value=''> 
											<option value="">please select</option>
                                                <?php foreach ($all_ward as $ward) { ?>
                                  <option value="<?php echo $ward->id; ?>" <?php if($ward->id==$voter->ward_no){echo 'selected';} ?>><?php echo $ward->w_name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blodd_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php if($group->group==$voter->bloodgroup){echo 'selected';} ?>> <?php echo $group->group; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        </div> 
										<div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('marital_status'); ?></label></br>
                                            <label class="radio-inline">
      <input type="radio" name="optradio" value="Married"  <?php if($voter->marital_status=='Married'){echo 'checked';} ?>>Married
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="Unmarried" <?php if($voter->marital_status=='Unmarried'){echo 'checked';} ?>>Unmarried
    </label>
                                        </div>
                                        </div>
                                         <div class="col-lg-6">
                                        <?php if (empty($id)) { ?>
                                            <div class="form-group pull-left" style="background-color: transparent;">
                                                <div class="payment_label"> 
                                                </div>
                                                <div class=""> 
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>

									<div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('remark'); ?></label>
                                           <textarea class="form-control col-md-12" name="remark"></textarea>
                                        </div>
                                        </div> 	
                                        <div class="col-lg-6">
                                           
                                             <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </div>

                                        
                                       
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
        
                                        
                                       
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-body col-md-5">
<style>
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 50px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
	.float-right{
	float:right;
margin-right:10%;	
}
</style>

		<div class="col-lg-12">
			<div style="background:#1a7bb9;padding:8px;">
			<h4 style="color:#fff;">Latest Update Disposition</h4>
		</div>
			<ul class="timeline">
			<?php foreach($timeline as $tt) { ?>
				<li>
					<a target="_blank" href=""><?php 
					if($tt->disposition!=''){
						foreach($Dispostion as $dd) {
							if($tt->disposition==$dd->dispostion_id){
								$disp=$dd->dispostion_title;
							}
						}
					}    						
					echo $disp;
					?></a>
					<a href="#" class="float-right"><?php echo $tt->date; ?></a>
					<p style="width: 90%;"><?php echo $tt->remark; ?></p>
				</li>
			<?php } ?>
			</ul>
		</div>
			
            </div>
            
        </section>
<?php }else{ ?>
        <section class="panel col-md-12">
            <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <?php
                    echo lang('add_new_voter');
                ?>
            </header>

            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                             
                                    <form role="form" action="voter/addNew" method="post" enctype="multipart/form-data">


                <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                        </div>
                    </div>
					
					<div class="form-group last col-md-6">
                        <label class="control-label">Voter Id Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url1"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                        </div>
                    </div>


                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->email)) {
                                                echo $voter->email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        </div> 
										<div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                                            <input type="text" class="form-control" name="age" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_id'); ?></label>
                                            <input type="text" class="form-control" name="voter_id" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-group">        
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="" required>
                                        </div>
                                        </div> 
                                         
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                                            <select class="form-control m-bot15" name="category" value=''> 
                                                <?php foreach ($categorys as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                                            <select class="form-control m-bot15" name="contacted" value=''>
                                               
                                                <?php foreach ($Dispostion as $dis) { ?>
                                                    <option value="<?php echo $dis->dispostion_id; ?>"><?php echo $dis->dispostion_title; ?> </option>
                                                <?php } ?>
                                           
                                            </select>
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        </div> 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male"> Male </option>
                                                <option value="Female"> Female </option>
                                                <option value="Others"> <?php echo lang('others'); ?> </option>
                                            </select>
                                        </div>
                                        </div> 
                                      
                                        <div class="col-lg-6">

                                        <div class="form-group">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" placeholder="">      
                                        </div>
                                        </div> 
										 
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('ward_no'); ?></label>
                                            <select class="form-control m-bot15" name="wardno" value=''>
<option value="">please select</option>											
                                                <?php foreach ($all_ward as $ward) { ?>
                                  <option value="<?php echo $ward->id; ?>"><?php echo $ward->w_name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blodd_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>"> <?php echo $group->group; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        </div> 
										<div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('marital_status'); ?></label></br>
                                            <label class="radio-inline">
      <input type="radio" name="optradio" value="Married">Married
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="Unmarried">Unmarried
    </label>
                                        </div>
                                        </div>
                                         <div class="col-lg-6">
                                        <?php if (empty($id)) { ?>
                                            <div class="form-group pull-left" style="background-color: transparent;">
                                                <div class="payment_label"> 
                                                </div>
                                                <div class=""> 
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>

									<div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('remark'); ?></label>
                                           <textarea class="form-control col-md-12" name="remark"></textarea>
                                        </div>
                                        </div> 	
                                        <div class="col-lg-6">
                                           
                                             <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                        </div>
        
                                        
                                       
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
           <div class="panel-body col-md-5">

		<div class="col-lg-12">
			<div style="background:#1a7bb9;padding:8px;">
			<h4 style="color:#fff;">Latest Update Dispostion</h4>
		</div>
			<ul class="timeline">
				<li>

				</li>
			</ul>
		</div>
			
            </div> 
        </section>
<?php } ?>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
