<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('import'); ?>  <?php echo lang('bulk'); ?> <?php echo lang('voter'); ?> (xl, xlsx, csv)
                <?php
                $message = $this->session->flashdata('message');
                if (!empty($message)) {
                    ?>
                    <code class="flash_message pull-right"> <?php echo $message; ?></code>
                <?php } ?> 
            </header>
            <div class="row">
                <div class="col-md-4">
                    <blockquote>
                        <a href="files/downloads/xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                        <br> <?php echo lang('please_follow_the_exact_format'); ?>. 
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" action="<?php echo site_url('import/importfiledynamic') ?>" class="clearfix" method="post" enctype="multipart/form-data"> 
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1"> Choose Files</label>
                                    <input type="file" class="form-control" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv">
                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                    <input type="hidden" name="tablename"value="voter">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right"><?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </section>
</section>


<style>


    .flash_message{
        padding: 3px;
        text-align: center;
        margin-left: 0px;
        margin-top: 0px;
    }

</style>


<!-- #######################################################################-->





