<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <header class="panel-heading"> 
            <?php echo lang('financial_report'); ?> 
            <div class="col-md-1 pull-right">
                <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
            </div>
        </header>
        <div class="col-md-12">
            <div class="col-md-7 row">
                <section>
                    <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!--     <label class="control-label col-md-3">Date Range</label> -->
                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-addon"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-6 no-print">
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-7">


                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('donation'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?> </th>
                                <th> </th>
                                <th> </th>
                                <th class="hidden-phone"> <?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($donations as $donation) {
                                if ($donation->type == 'cash') {
                                    $all_donations['cash'][] = $donation->amount;
                                }
                            }
                            ?>
                            <?php
                            foreach ($donations as $donation) {
                                if ($donation->type == 'cheque') {
                                    $all_donations['cheque'][] = $donation->amount;
                                }
                            }
                            ?>
                            <?php
                            foreach ($donations as $donation) {
                                if ($donation->type == 'others') {
                                    $all_donations['others'][] = $donation->amount;
                                }
                            }
                            ?>
                            <tr class="">
                                <td><strong><?php echo lang('cash'); ?></strong></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($all_donations['cash'])) {
                                        $cash = array_sum($all_donations['cash']);
                                    }
                                    if (empty($cash)) {
                                        $cash = 0;
                                    }
                                    echo $cash;
                                    ?>
                                </td>
                            </tr>

                            <tr class="">
                                <td><strong><?php echo lang('cheque'); ?></strong></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($all_donations['cheque'])) {
                                        $cheque = array_sum($all_donations['cheque']);
                                    }
                                    if (empty($cheque)) {
                                        $cheque = 0;
                                    }
                                    echo $cheque;
                                    ?>
                                </td>
                            </tr>

                            <tr class="">
                                <td><strong><?php echo lang('others'); ?></strong></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($all_donations['others'])) {
                                        $others = array_sum($all_donations['others']);
                                    }

                                    if (empty($others)) {
                                        $others = 0;
                                    }
                                    echo $others;
                                    ?>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </section>


                <section></section>


                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('expense'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?> </th>
                                <th></th>
                                <th></th>
                                <th class="hidden-phone"> <?php echo lang('amount'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expense_categories as $category) { ?>
                                <tr class="">
                                    <td><strong><?php echo $category->category ?></strong></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        foreach ($expenses as $expense) {
                                            $category_name = $expense->category;


                                            if (($category->category == $category_name)) {
                                                $amount_per_category[] = $expense->amount;
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_expense_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </section>
            </div>


            <style>
                .billl{
                    background: #39B24F !important;
                }

                .due{
                    background: #39B1D1 !important;
                }
            </style>



            <div class="col-lg-5">







                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body due">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('total'); ?>  <?php echo lang('donation'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        echo $total_donation = $cash + $cheque + $others;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>





                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body due">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_expense'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                            echo array_sum($total_expense_by_category);
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>







            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
