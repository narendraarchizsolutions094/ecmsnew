<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($notice->id))
                    echo lang('edit_notice');
                else
                    echo lang('add_notice');
                ?>
            </header>


            <style>
                .des{
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
            </style>


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
                        <form role="form" action="notice/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
                                if (!empty($notice->name)) {
                                    echo $notice->name;
                                }
                                ?>' placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                            </div>

                            <div class="form-group des">
                                <label class="control-label"><?php echo lang('description'); ?></label>
                                <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                            </div>





                            <input type="hidden" name="id" value='<?php
                            if (!empty($notice->id)) {
                                echo $notice->id;
                            }
                            ?>'>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </section>
    </section>
    <!-- page end-->
</section>

<!--main content end-->
<!--footer start-->
