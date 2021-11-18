<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($donation->id))
                    echo lang('add_donation');
                else
                    echo lang('add_new_donation');
                ?>
            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table row">
                    <div class="clearfix col-md-12">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="donation/addDonation" class="clearfix" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('donor'); ?></label>
                                <select class="form-control js-example-basic-single area"  name="donor" value=''> 
                                    <option value=""> </option>
                                    <?php foreach ($donors as $donor) { ?>                                        
                                        <option value="<?php echo $donor->id; ?>"><?php echo $donor->name; ?> </option>
                                    <?php } ?> 
                                </select>
                            </div>





                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                                <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('date');
                                }
                                if (!empty($donation->date)) {
                                    echo $donation->date;
                                }
                                ?>' placeholder="" readonly="">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('door'); ?></label>
                                    <select class="form-control js-example-basic-single area"  name="type" value=''>                                       
                                        <option value="cash"> <?php echo lang('cash'); ?> </option>
                                        <option value="cheque"> <?php echo lang('cheque'); ?> </option>
                                        <option value="others"> <?php echo lang('Others'); ?> </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                                <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('amount');
                                }
                                if (!empty($donation->amount)) {
                                    echo $donation->amount;
                                }
                                ?>' placeholder="">
                            </div>






                            <input type="hidden" name="id" value='<?php
                            if (!empty($donation->id)) {
                                echo $donation->id;
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
