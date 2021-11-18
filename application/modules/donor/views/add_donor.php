<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($donor->id))
                    echo lang('add_donor');
                else
                    echo lang('add_new_donor');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table row">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($donor->name)) {
                                    echo $donor->name;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($donor->email)) {
                                    echo $donor->email;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('address');
                                }
                                if (!empty($donor->address)) {
                                    echo $donor->address;
                                }
                                ?>' placeholder="">
                            </div>
                            
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($donor->phone)) {
                                    echo $donor->phone;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('profession'); ?></label>
                                <input type="text" class="form-control" name="profession" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('profession');
                                }
                                if (!empty($donor->profession)) {
                                    echo $donor->profession;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                                <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('age');
                                }
                                if (!empty($donor->age)) {
                                    echo $donor->age;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            
                           
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                <select class="form-control m-bot15" name="sex" value=''>
                                    <option value="Male" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Male') {
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
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Female') {
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
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Others </option>
                                </select>
                            </div>
                           
                            

                            <input type="hidden" name="id" value='<?php
                            if (!empty($donor->id)) {
                                echo $donor->id;
                            }
                            ?>'>
                            
                            <div class="form-group col-md-12">
                               <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
