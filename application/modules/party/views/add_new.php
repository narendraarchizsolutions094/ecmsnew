
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7">
            <header class="panel-heading">
                <?php
                if (!empty($party->id)) {
                    echo lang('edit_party');
                } else {
                    echo lang('add_new_party');
                }
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="party/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group">


                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                if (!empty($party->name)) {
                                    echo $party->name;
                                }
                                ?>' placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                if (!empty($party->email)) {
                                    echo $party->email;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">


                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                if (!empty($party->address)) {
                                    echo $party->address;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                if (!empty($party->phone)) {
                                    echo $party->phone;
                                }
                                ?>' placeholder="">
                            </div>

                            <div class="form-group"> 

                                <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                                <select class="form-control m-bot15" name="language" value=''>
                                    <option value="english" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'english') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('english'); ?> 
                                    </option>
                                    <option value="spanish" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'spanish') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('spanish'); ?>
                                    </option>
                                    <option value="french" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'french') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('french'); ?>
                                    </option>
                                    <option value="italian" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'italian') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('italian'); ?>
                                    </option>
                                    <option value="portuguese" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'portuguese') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('portuguese'); ?>
                                    </option>
                                </select>

                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($party->id)) {
                                echo $party->id;
                            }
                            ?>'>
                            <div class="form-group">
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
