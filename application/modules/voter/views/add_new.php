<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($voter->id))
                    echo lang('edit_voter');
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
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="voter/addNew" method="post" enctype="multipart/form-data">





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


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($voter->email)) {
                                                echo $voter->email;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">        
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                                        </div>

                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('area'); ?></label>
                                            <select class="form-control js-example-basic-single area"  name="area" value=''> 
                                                <option value=""> </option>
                                                <?php foreach ($areas as $area) { ?>                                        
                                                    <option value="<?php echo $area->name; ?>"><?php echo $area->name; ?> </option>
                                                <?php } ?> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                                            <select class="form-control m-bot15" name="category" value=''> 
                                                <?php foreach ($categorys as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                                            <select class="form-control m-bot15" name="contacted" value=''>
                                                <option value="Yes" <?php
                                                if (!empty($voter->contacted)) {
                                                    if ($voter->contacted == 'Yes') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('yes'); ?> </option>
                                                <option value="No" <?php
                                                if (!empty($voter->contacted)) {
                                                    if ($voter->contacted == 'No') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> selected> <?php echo lang('no'); ?> </option>

                                            </select>
                                        </div>

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

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                                            <select class="form-control m-bot15" name="category" value=''> 
                                                <?php foreach ($categorys as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                    if (!empty($category->category)) {
                                                        if ($category->category == $voter->category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> ><?php echo $category->category; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>

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

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blodd_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php
                                                    if (!empty($setval)) {
                                                        if ($group->group == set_value('bloodgroup')) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($voter->bloodgroup)) {
                                                        if ($group->group == $voter->bloodgroup) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $group->group; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>

                                        <?php if (empty($id)) { ?>

                                            <div class="form-group" style="background-color: transparent;">
                                                <div class="payment_label"> 
                                                </div>
                                                <div class=""> 
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div>

                                        <?php } ?>

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
                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                        </section>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
