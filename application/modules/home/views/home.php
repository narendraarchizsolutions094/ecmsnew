<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="common/js/google-loader.js"></script>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!--state overview start-->



        <?php if ($this->ion_auth->in_group(array('Volunteer'))) { ?>
            <div class="state-overview col-md-12" style="padding: 23px 0px;">
                <div class="col-md-7 col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo lang('notice'); ?>
                        </header>
                        <div class="panel col-md-12">
                            <div class="task-content panel">
                                <ul class="task-list">
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th> <?php echo lang('title'); ?></th>
                                                <th> <?php echo lang('description'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($notices as $notice) { ?>
                                                <tr class="">
                                                    <td> <?php echo $notice->title; ?></td>
                                                    <td> <?php echo $notice->description; ?></td>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </ul>

                                <div class="panel col-md-12 add-task-row">
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <a class="btn btn-success btn-sm pull-left" href="notice/addNewView"><?php echo lang('add'); ?> <?php echo lang('notice'); ?></a>
                                    <?php } ?>
                                    <a class="btn btn-default btn-sm pull-right" href="notice"><?php echo lang('all'); ?> <?php echo lang('notice'); ?></a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        <?php } ?>


        <?php if ($this->ion_auth->in_group('admin')) { ?>
            <div class="state-overview col-md-12" style="padding: 23px 0px;">
                <div class="clearfix">
<!-----

                    <div class="col-lg-3 col-sm-6">
                        <?php //if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="voter">
                            <?php //} ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php //echo lang('voter'); ?>
                                </div>
                                <div class="value">
                                    <h1 class="">
                                        <?php
                                       // $this->db->where('party_id', $this->party_id);
                                       // $this->db->from('voter');
                                      //  $count = $this->db->count_all_results();
                                       // echo $count;
                                        ?>
                                    </h1>
                                    <p><?php //echo lang('voter'); ?></p>
                                </div>
                            </section>
                            <?php //if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php //} ?>
                    </div>

--->
                    <style>

                        .panel-body{
                            background: none;
                        }


                    </style>


                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="volunteer">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php echo lang('volunteer'); ?>
                                </div>
                                <div class="value"> 
                                    <h1 class="">
                                        <?php
                                        $this->db->where('party_id', $this->party_id);
                                        $this->db->from('volunteer');
                                        $count = $this->db->count_all_results();
                                        echo $count;
                                        ?>
                                    </h1>
                                    <p><?php echo lang('volunteer'); ?></p>
                                </div>
                            </section>
                            <?php if (!$this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="event">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    Event
                                </div>
                                <div class="value">
                                    <h1 class="">
                                        <?php
                                        $event_dates = $this->event_model->getEvent();
                                        $i = 0;
                                        foreach ($event_dates as $event_date) {
                                            if (strtotime($event_date->date) > time()) {
                                                $i = $i + 1;
                                            }
                                        }
                                        echo $i;
                                        ?>
                                    </h1>
                                    <p><?php echo lang('upcoming_events'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="area">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    Ward No
                                </div>
                                <div class="value">
                                    <h1 class="">
                                        <?php
                                        $this->db->where('party_id', $this->party_id);
                                        $this->db->from('area');
                                        $count = $this->db->count_all_results();
                                        echo $count;
                                        ?>
                                    </h1>
                                    <p>Ward No</p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <section class="panel">
                        </section>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="sms/sendView">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php echo lang('bulk_sms'); ?>
                                </div>
                                <div class="value">
                                    <h1> <i class="fa fa-location-arrow"></i> </h1>
                                    <p> <?php echo lang('send_sms_to_voter_volunteer'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="snw">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php echo lang('analysis'); ?>
                                </div>
                                <div class="value">
                                    <h1> <i class="fa fa-archive"></i> </h1>
                                    <p><?php echo lang('campaign_analysis'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                   <!--- <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="finance/expense">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php echo lang('expense'); ?>
                                </div>
                                <div class="value">
                                    <h1> <i class="fa fa-money"></i> </h1>
                                    <p><?php echo lang('expense_report'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>---->
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="settings">
                            <?php } ?>
                            <section class="panel">
                                <div class="dash-heading">
                                    <?php echo lang('settings'); ?>
                                </div>
                                <div class="value">
                                    <h1> <i class="fa fa-gears"></i> </h1>
                                    <p><?php echo lang('settings'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>


                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>





                    <div class="col-md-8">
                        <aside class="calendar_ui col-md-12 panel calendar_ui">
                            <section class="">
                                <div class="">
                                    <div id="calendar" class="has-toolbar calendar_view"></div>
                                </div>
                            </section>
                        </aside>
                    </div>


                   <!--- <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('D d F, Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo number_format($this_day['expense'], 2, '.', ','); ?> <hr>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('F, Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo number_format($this_month['expense'], 2, '.', ','); ?> <hr>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo number_format($this_year['expense'], 2, '.', ','); ?> <hr>
                                </div>
                            </div>
                        </section>
                    </div>--->
                <?php } ?>
            </div>

        <?php } ?>



        <?php if ($this->ion_auth->in_group('superadmin')) { ?>
            <section class="col-md-12">
                <div class="col-lg-6 col-sm-6 row">
                    <h1><span class="livee"><?php echo lang('active')?></span> <?php echo lang('partys')?></h1>
                </div>
            </section>
            <?php
            foreach ($partys as $party) {
                $party_ion_id = $this->party_model->getPartyByIonUserId($party->id)->ion_user_id;
                $status = $this->db->get_where('users', array('id' => $party->ion_user_id))->row()->active;
                if ($status == 1) {
                    ?>    
                    <div class="col-lg-6 col-sm-6 superadmin">
                        <section class="panel">
                            <div class="symbol super">
                                <?php echo $party->name; ?>
                            </div>
                            <div class="value"> 
                                <p class="">
                                    Email:   <?php echo $party->email; ?>
                                </p>
                                <p class="">
                                    Address:   <?php echo $party->address; ?>
                                </p>
                                <p class="">
                                    Phone:  <?php echo $party->phone; ?>
                                </p>
                            </div>
                        </section>
                    </div>
                    <?php
                }
            }
        }
        ?>



        <style>

            table{
                box-shadow: none;
            }

            .fc-head{

                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);

            }

            .panel-body{
                background: #fff;
            }

            thead{
                background: #fff;
            }

            .panel-body {
                background: #fff;
            }

            .panel-heading {
                border-radius: 0px;
                background: #fff !important;
                color: #000;
                padding-left: 10px;
                font-size: 13px !important;
                margin-top: 3px;
                text-align: center;
            }

            .add_voter{
                background: #009988;
            }

            .add_appointment{
                background: #f8d347;
            }

            .add_prescription{
                background: blue;
            }

            .add_lab_report{

            }

            .y-axis li span {
                display: block;
                margin: -20px 0 0 -25px;
                padding: 0 20px;
                width: 40px;
            }

            .sale_color{
                background: #69D2E7 !important;
                padding: 10px !important;
                font-size: 5px;
                margin-right: 10px;
            }

            .expense_color{
                background: #F38630 !important;
                padding: 10px !important;
                font-size: 5px;
                margin-right: 10px;
            }

            audio, canvas, progress, video {
                display: inline-block;
                vertical-align: baseline;
                width: 100% !important;
                height: 101% !important;
                margin-bottom: 18%;
            }  


            .panel-heading{
                margin-top: 0px;
            }

            .super {
                width: 40% !important;
                padding: 50px 15px !important;
                color: #fff;
                font-size: 20px;
                background: #345678 !important;
                float: left;
            }

            .superadmin .value {
                width: 58% !important;
                padding-top: 21px;
                float: left;
                background: #fff;
                padding: 22px 34px;
                margin-bottom: 20px;
            }


        </style>



        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->




















