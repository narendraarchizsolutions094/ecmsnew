<!DOCTYPE html>
<html lang="en" <?php
if (!$this->ion_auth->in_group(array('superadmin'))) {
    $this->db->where('party_id', $this->session->userdata('party_id'));
    $settings_lang = $this->db->get('settings')->row();
    if (!empty($settings_lang->language) && $settings_lang == 'arabic') {
        ?>
              dir="rtl"
          <?php } else { ?>
              dir="ltr"
              <?php
          }
      }
      ?>>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">
        <title><?php echo $this->router->fetch_class(); ?> | <?php echo $this->db->get('settings')->row()->system_vendor; ?> </title>
        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
        <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
		<style>
		.dropdown-menu.extended li 		.n-mark-btn{
					padding: 0px !important;
    width: 40px;
    border: none;
    position: absolute;
    right: 0px;
    color: #a9d86e;
    display: inline-block;
					}
		</style>


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->


        <?php
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            $this->db->where('party_id', $this->session->userdata('party_id'));
            $settings_lang = $this->db->get('settings')->row();
            if (!empty($settings_lang->language) && $settings_lang == 'arabic') {
                ?>

                <style>
                    #main-content {
                        margin-right: 211px;
                        margin-left: 0px; 
                    }

                    body {
                        background: #f1f1f1;

                    }
				

                </style>

                <?php
            }
        }
        ?>

    </head>

    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-dedent fa-bars tooltips"></div>
                </div>
                <!--logo start-->
                <?php
                if (!$this->ion_auth->in_group(array('superadmin'))) {
					
                    $this->db->where('party_id', $this->session->userdata('party_id'));
                    $settings_title = $this->db->get('settings')->row();
					
					if(!empty($settings_title->title)){ 
					
						$settings_title = explode(' ', $settings_title->title);
                    ?>
                    <a href="" class="logo">
                        <strong>
                            <?php echo $settings_title[0]; ?><span><?php
                                if (!empty($settings_title[1])) {
                                    echo $settings_title[1];
                                }
                                ?></span>
                        </strong>
                    </a>

                <?php }
				} else { ?>

                    <a href="" class="logo">
                        <strong>
                            Election
                            <span>
                                Campaign
                            </span>
                        </strong>
                    </a>

                <?php } ?>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
					<?php
						if ($this->ion_auth->in_group(array('superadmin'))) {
						
						
						}else if ($this->ion_auth->in_group(array('admin'))) {
							
							$userid   = $this->session->userdata('user_id');
							$party_id = $this->party_id;
						//	$party_id = $this->session->userdata('admin_id');
							//$vtrarr = $this->db->select("id")->where('party_id', $this->party_id)->where('add_date', date('d-m-y'))->count_all_results('voter');
						//	$vtrarr = $this->db->select("id")->where('party_id', $this->party_id)->where('add_date', date('d-m-y'))->get('voter')->result();
							
							
						
							$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
							
							$this->db->select("ntf.*,usr.username");
							
							$this->db->where("(ntf.reciever = '$party_id' OR FIND_IN_SET($party_id, ntf.mult_reciever))");
							$this->db->where("(ntf.mfor = 'volunteer' OR ntf.mfor = 'voter')");
							$this->db->where("ntf.status = 0 OR ntf.status = 2");
							//$this->db->where();
							$this->db->from("notification ntf");
							$this->db->join("users usr", "usr.id = ntf.sender","LEfT");
							//$this->db->group_by('usr.username');
							$ntfarr = $this->db->get()->result();	
					
							$teamntf = $vtrntf = $vltnttf = array();
							$totvtr = $totteam = 0;
							if(!empty($ntfarr)){
								
								foreach($ntfarr as $ind => $ntf){
									
									$vtrntf[$ntf->username][$ntf->mfor][] = $ntf;
									$totvtr++;
										
									
								}
								
							}	
							$this->db->select("ntf.*,tm.id as team_id,tm.name,tm.members,tm.task");
							
							$this->db->where("(ntf.reciever = '$party_id' OR FIND_IN_SET($party_id, ntf.mult_reciever))");
							$this->db->where("(ntf.status = '0' OR status = '2')");
							$this->db->where("ntf.mfor", "team");
							
							$this->db->order_by("ntf.id DESC");
							$this->db->from("notification ntf");
							$this->db->join("team tm", "tm.id = ntf.parent","LEFT");
							
							//$this->db->group_by('usr.username');
							$teamntf = $this->db->get()->result();
					
							/* $this->db->select('usr.username,vtr.ion_user_id,COUNT(vtr.ion_user_id) as total');
							 $this->db->from("voter vtr");
							 $this->db->join("users usr", "usr.id = vtr.ion_user_id");
							 $this->db->where('vtr.add_date', date('d-m-y'));
							 $this->db->where("usr.party_id" , $party_id);
						
							 $this->db->group_by('vtr.ion_user_id'); 
						
							 $vnotf = $this->db->get()->result();
							
							 $this->db->select('usr.username,vtr.ion_user_id,COUNT(ion_user_id) as total');
							  $this->db->from("volunteer vtr");
							 $this->db->join("users usr", "usr.id = vtr.ion_user_id");
							 $this->db->where('vtr.add_date', date('d-m-y'));
							 $this->db->where("usr.party_id" , $party_id);
				
							 $this->db->group_by('vtr.ion_user_id'); 
							
							 $vltarr = $this->db->get()->result();*/
							
							
							/*
								$qry  = "SELECT * FROM team WHERE DATE(added_date) = DATE(NOW()) AND party_id = '$this->party_id' ORDER BY id DESC";
					
							$teamnoice = $this->db->query($qry)->result();
							*/
						/*	$qry  = "SELECT * FROM notification WHERE DATE(created_date) = DATE(NOW()) AND party_id = '$this->party_id' AND added_by != '$userid'  ORDER BY id DESC";
							
							
							$assignvtr = $this->db->query($qry)->result();
							$tot_voters = count($vnotf) +count($vltarr) + count($assignvtr);
							*/
						}else {
						
							$userid = $this->session->userdata('user_id');
							
							//$vtrarr = $this->db->select("id")->where('party_id', $this->party_id)->where('add_date', date('d-m-y'))->get('voter')->result();
							
							$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
							
							$this->db->select("ntf.*,usr.username");
							
							$this->db->where("(ntf.reciever = '$userid' OR FIND_IN_SET($userid, ntf.mult_reciever))");
							$this->db->where("(ntf.mfor = 'volunteer' OR ntf.mfor = 'voter')");
							$this->db->where("ntf.status = 0 OR ntf.status = 2");
							//$this->db->where();
							$this->db->from("notification ntf");
							$this->db->join("users usr", "usr.id = ntf.sender","LEfT");
							//$this->db->group_by('usr.username');
							$ntfarr = $this->db->get()->result();	
					
							$teamntf = $vtrntf = $vltnttf = array();
							$totvtr = $totteam = 0;
							if(!empty($ntfarr)){
								
								foreach($ntfarr as $ind => $ntf){
									
									$vtrntf[$ntf->username][$ntf->mfor][] = $ntf;
									$totvtr++;
										
									
								}
								
							}	
							$this->db->select("ntf.*,tm.id as team_id,tm.name,tm.members,tm.task");
							
							$this->db->where("(ntf.reciever = '$userid' OR FIND_IN_SET($userid, ntf.mult_reciever))");
							$this->db->where("(ntf.status = '0' OR status = '2')");
							$this->db->where("ntf.mfor", "team");
							
							$this->db->order_by("ntf.id DESC");
							$this->db->from("notification ntf");
							$this->db->join("team tm", "tm.id = ntf.parent","LEFT");
							
							//$this->db->group_by('usr.username');
							$teamntf = $this->db->get()->result();
							
								$where = '(type ="global" OR reciever = "'.$userid.'") AND status = "0"';
							$notice = $this->db->select("id,title,description as descr,type,created_date,mrk_read,mrk_delete,status")->where($where)->get("notice")->result();
						
							
							
							
						/*	
							$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
							 $this->db->select('usr.username,vtr.ion_user_id,COUNT(vtr.ion_user_id) as total');
							 $this->db->from("voter vtr");
							 $this->db->join("users usr", "usr.id = vtr.ion_user_id");
							 $this->db->where('vtr.add_date', date('d-m-y'));
							 $this->db->where('vtr.party_id', $this->session->userdata("party_id"));
							
							
							 $this->db->group_by('vtr.ion_user_id'); 
						
							 $vnotf = $this->db->get()->result();
							
							 $this->db->select('usr.username,vtr.ion_user_id,COUNT(ion_user_id) as total');
							  $this->db->from("volunteer vtr");
							 $this->db->join("users usr", "usr.id = vtr.ion_user_id");
							 $this->db->where('vtr.add_date', date('d-m-y'));
							 $this->db->where('vtr.party_id', $this->session->userdata("party_id"));
						
							 $this->db->group_by('vtr.ion_user_id'); 
						
							 $vltarr = $this->db->get()->result();
							
							
							
							
							$vltrid = $this->db->select("*")->where("email", $this->session->userdata("email"))->get("volunteer")->row()->id;
							
							
							$qry = "SELECT id,msg as descr,created_date,mrk_read,mrk_delete,status, 'messages' as type FROM `tbl_conversation` WHERE team_id IN(SELECT id FROM `team` WHERE FIND_IN_SET($vltrid, members)) ORDER BY id DESC";
					
								$qry  = "SELECT * FROM team WHERE DATE(added_date) = DATE(NOW()) AND FIND_IN_SET($vltrid, members)  AND added_by != '$userid' ORDER BY id DESC";
						
							
							$teamnoice = $this->db->query($qry)->result();
				
							$qry  = "SELECT * FROM notification WHERE DATE(created_date) = DATE(NOW())  AND FIND_IN_SET($vltrid, reciever)  AND added_by != '$userid' ORDER BY id DESC";
							
							$assignvtr = $this->db->query($qry)->result();
							$tot_voters = count($vnotf) +count($vltarr) + count($assignvtr); */
						}
			
						
						?>
						
						<!-- voter notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin','Voter', 'Accountant', 'Volunteer', 'Nurse', 'Laboratorist'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
								
                                <a data-toggle="dropdown" class="dropdown-toggle voter-notice" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-warning" id ="tot-vtr-ntf"> <?php echo (!empty($totvtr)) ? $totvtr  : "0"; ?>  
                        
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $totvtr;
                                            if ($totvtr <= 1) {
                                            //    echo lang('voter_registerred_today');
											echo " Registerred / Asign  Today";
                                            } else {
                                                //echo lang('voters_registerred_today');
												echo " Registerred / Asign Today";
                                            }
                                            ?> </p>
                                    </li> 
									
								<?php   
							
								if (!empty($vtrntf)){
										$ind = 0;
										foreach($vtrntf as $user => $actarr){
											
											if($ind > 5) break;
											
											
											foreach($actarr as $ind => $ntf){
												
												if($ind == "voter"){
													?><li><a href="voter"><?php echo $user; ?> added <b><?php echo count($ntf); ?> Voter<?php echo count($ntf) ?"s" :""; ?></b></a> </li><?php	
											}else{
												?><li><a href="volunteer"><?php echo $user; ?> added <b><?php echo count($ntf); ?> Volunteer<?php echo count($ntf) ?"s" :""; ?></b></a> </li><?php	
											}
												
									
												
											}
											$ind++;
										}		
										
									} ?>
			
					
						
									
                                    <li>
                                        <a href="voter" style = "width:49%;padding:2px!important;"><p class="green"><?php echo lang('see_all_voters'); ?></p></a>
										<a href="volunteer" style = "width:49%;padding:2px!important"><p class="green">See All Volunteer</p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
						
						<?php if ($this->ion_auth->in_group(array('Volunteer','Voter'))) { ?> 
							
							<li id="header_notification_bar" class="dropdown">
								
                                <a data-toggle="dropdown" class="dropdown-toggle notify-notice" href="#">
                                    <i class="fa fa-user"></i> 
                                    <span class="badge bg-danger total-notice">	<?php if(!empty($notice)){ 
											$cnt = 0;
											
											foreach ($notice as $ind => $ntc){
												
												$delarr = $permarr = array();
												if(!empty($notice->mrk_delete)){
													
													$delarr  = explode(",", $notice->mrk_delete);
												}
												
												if(!empty($ntc->mrk_read)){
								
													$permarr = explode(",", $ntc->mrk_read);
												
												}
													
													
												if(in_array($userid , $permarr) or in_array($userid , $delarr)) { 
													
													continue;
												}else{
													$cnt++;
												}
											}			
										    echo $cnt;
										}else{
											echo "0";
										} ?> 
                        
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow">
										<span class="total-notice">
								 <?php echo count($notice); ?>	Notice
										<?php 
                                         /*   echo $tot_voters . ' ';
                                            if ($tot_voters <= 1) {
                                                echo lang('voter_registerred_today');
                                            } else {
                                                echo lang('voters_registerred_today');
                                            } */ 
                                            ?> </span></p>
                                    </li> 
									<?php foreach ($notice as $ind => $ntc){
										
											$permarr = $ntc->mrk_read;
											$permarr = $delarr = array();
											if(!empty($ntc->mrk_read)){
								
												$permarr = explode(",", $ntc->mrk_read);
											
											}
											if(!empty($notice->mrk_delete)){
													
												$delarr  = explode(",", $notice->mrk_delete);
											}
										if(in_array($userid , $permarr) or in_array($userid , $delarr)) { 
											
											continue;
										}
										
										if(date("Y-m-d", strtotime($ntc->created_date)) == date("Y-m-d")){
											
											$dt = date("h:i A", strtotime($ntc->created_date)); 
										}else{
											$dt = date("d, M Y", strtotime($ntc->created_date)); 
										}
										
										if(!empty($ntc->type)  == "global"){
											
												$link = "notice";
											?><li><a href="<?php echo $link; ?>">
											<b><?php echo $ntc->title; ?></b><br />
											<?php echo $ntc->descr; ?><b class="pull-right"><?php echo $dt; ?></b>
												
												</a></li>
											<?php
											
										}else if(!empty($ntc->type)  == "messages"){
											
													
											$link = "notice/message";
											?><li><a href="<?php echo $link; ?>"><?php echo $ntc->descr; ?><b class="pull-right"><?php echo $dt; ?></b>
												
												</a></li>
											<?php
										
										}else{
												$link = "team";
											?><li><a href="<?php echo $link; ?>"><?php echo $ntc->title; ?><br>
											<small><?php echo $ntc->descr; ?></small> <b class="pull-right"><?php echo $dt; ?></b></a>
											</li><?php
									
										}
										
										if($ind > 4)  break;
										
										
										?>
									<?php
									} ?>		
                                    <li>
                                        <a href="notice"><p class="green">See All Notice</p></a>
                                    </li>
                                </ul>
                            </li>
							
							
							
							
						
						<?php } ?>
						<?php if ($this->ion_auth->in_group(array('admin', 'Volunteer', 'Nurse', 'Laboratorist', 'Voter'))) { ?> 
						
						  <li id="header_notification_bar_3" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-success">       
                                        <?php
                                       echo (!empty($teamntf)) ?   count($teamntf) : "0";
                                        ?>
                                    </span>
                                </a>
								
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php echo count($teamntf)
											
                                            ?> Team Notification</p>
                                    </li>
									<?php if(!empty($teamntf)){
										foreach($teamntf as $ind => $tm){
											
											if($ind > 5) break;
											
											
											$mbr = (!empty($tm->members)) ? explode(",", $tm->members) : array();
											
											if(date("Y-m-d", strtotime($tm->created_date))){
												
												$day = "Today , ".date("h:i A", strtotime($tm->created_date)); 
											}else{
												$day = date("d M Y", strtotime($tm->created_date));
											} 
											
										?><li><a href="<?php echo $tm->link; ?>"><b><?php echo $tm->name; ?> </b><br />
										<?php  echo count($mbr)." members"; ?> <i class="pull-right"><?php  echo $day; ?></i> 
										</a>
										</li><?php		
										}
									} ?>
                                    <li>
                                        <a href="team"><p class="green">See All Team</p></a>
                                    </li>
                                </ul>
                            </li>
						
						<?php } ?>
                        <!-- voter notification end -->  
                        <!-- donor notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Volunteer', 'Nurse', 'Laboratorist', 'Voter'))) { ?> 
                            <li id="header_notification_bar" class="dropdown" style="display:none;">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-success">       
                                        <?php
                                        $this->db->where('party_id', $this->party_id);
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('donor');
                                        $query = $query->result();
                                        foreach ($query as $donor) {
                                            $donor_number[] = '1';
                                        }
                                        if (!empty($donor_number)) {
                                            echo $donor_number = array_sum($donor_number);
                                        } else {
                                            $donor_number = 0;
                                            echo $donor_number;
                                        }
                                        ?>
                                    </span>
                                </a>
								
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php
                                            echo $donor_number . ' ';
                                            if ($donor_number <= 1) {
                                                echo lang('donor_registerred_today');
                                            } else {
                                                echo lang('donors_registerred_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="donor"><p class="green"><?php echo lang('see_all_donors'); ?></p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?> 
                        <!-- donor notification end -->  


                    </ul>
                </div>
                <div class="top-nav ">

                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="uploads/favicon.png" width="21" height="23">
                                <span class="username"><?php echo $this->ion_auth->user()->row()->username; ?></span>
                                <b class="caret"></b>
                            </a>

                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <?php if (!$this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href=""><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
                                <?php } ?>
								<?php if (!$this->ion_auth->in_group('admin')) { ?>
                                <li><a href="profile"><i class=" fa fa-suitcase"></i><?php echo lang('profile'); ?></a></li>
								<?php } ?>
                                <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href="settings"><i class="fa fa-cog"></i> <?php echo lang('settings'); ?></a></li>
                                <?php } ?>

                                <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                                <li><a href="auth/logout"><i class="fa fa-key"></i> <?php echo lang('log_out'); ?></a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
                        <code class="flashmessage pull-right"> <?php echo $message; ?></code>
                    <?php } ?> 
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="home"> 
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo lang('dashboard'); ?></span>
                            </a>
                        </li>
					
                        <?php // if ($this->ion_auth->in_group('admin','Volunteer')) { ?>
                           <!--- <li>
                                <a href="area">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php //echo lang('areas'); ?></span>
                                </a>
                            </li>----->
							 <?php if ($this->ion_auth->in_group(array('admin', 'Volunteer','Voter'))) { ?>
							 <li><a href="qrcode/index"><i class="fa fa-plus"></i>
                             <span>							 
							 <?php echo lang('added_qr'); ?>
							  <span></a></li>
							 <?php } ?>
                        <?php //} ?>
                           <?php if ($this->ion_auth->in_group(array('admin', 'Volunteer','Voter'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('volunteers'); ?></span>
                                </a>
                                
								 <ul class="sub">
                                    <li><a  href="volunteer"><i class="fa fa-user"></i> <?php echo lang('volunteers'); ?></a></li>
									<?php if ($this->ion_auth->in_group(array('admin'))) {?>
                                    <li><a href="imports/index"><i class="fa fa-arrow-right"></i><?php echo lang('import'); ?>  <?php echo lang('volunteers'); ?></a></li>
									<?php } ?>
								</ul>
                            </li>
						   <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin', 'Volunteer','Voter'))) { ?>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('voter'); ?> <?php echo lang('database'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="voter"><i class="fa fa-user"></i><?php echo lang('voter'); ?> <?php echo lang('database'); ?></a></li>
								<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <li><a  href="voter/voterCategory"><i class="fa fa-list-alt"></i><?php echo lang('voter'); ?> <?php echo lang('category'); ?></a></li>
								<?php } ?>
                                    <li><a href="import/index"><i class="fa fa-arrow-right"></i><?php echo lang('import'); ?> <?php echo lang('voter'); ?></a></li>
                                   
								</ul>
                            </li> 
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                          
                            <li><a  href="event"><i class="fa fa-calendar-o"></i><?php echo lang('event'); ?></a></li>
                            
                        <?php } ?>
						   <?php if ($this->ion_auth->in_group(array('admin', 'Volunteer','Voter'))) { ?>
						<li><a  href="snw"><i class="fa fa-file-text"></i><?php echo lang('snw'); ?></a></li>
						  <li><a  href="team"><i class="fa fa-users"></i><?php echo lang('team'); ?></a></li>
						<?php } ?>	
                      <!----  <?php ///if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-dollar"></i>
                                    <span><?php //echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="finance/expense"><i class="fa fa-money"></i><?php //echo lang('expense'); ?></a></li>
                                    <li><a  href="finance/addExpenseView"><i class="fa fa-plus-circle"></i><?php //echo lang('add_expense'); ?></a></li>
                                    <li><a  href="finance/expenseCategory"><i class="fa fa-edit"></i><?php //echo lang('expense_categories'); ?> </a></li>
                                </ul>
                            </li> 
                        <?php //} ?>





                        <?php //if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-user"></i>
                                    <span><?php //echo lang('donor') ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="donor"><i class="fa fa-user"></i><?php //echo lang('donor_list'); ?></a></li>
                                    <li><a  href="donor/addDonorView"><i class="fa fa-plus-circle"></i><?php //echo lang('add_donor'); ?></a></li>
                                </ul>
                            </li>
                        <?php //} ?>


                        <?php //if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-money"></i>
                                    <span><?php //echo lang('donation') ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="donation"><i class="fa fa-money"></i><?php //echo lang('all_donations'); ?></a></li>
                                    <li><a  href="donation/addDonationView"><i class="fa fa-plus-circle"></i><?php //echo lang('add_donation'); ?></a></li>
                                </ul>
                            </li>
                        <?php //} ?>
                       ---->






                       <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-hospital-o"></i>
                                    <span><?php echo lang('report'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="finance/financialReport"><i class="fa fa-book"></i><?php echo lang('financial_report'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-microphone"></i>
                                    <span><?php echo lang('notice'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="notice"><i class="fa fa-location-arrow"></i><?php echo lang('notice'); ?></a></li>
									<li><a  href="notification"><i class="fa fa-location-arrow"></i>Notification</a></li>
                                    <li><a  href="notice/addNewView"><i class="fa fa-list-alt"></i><?php echo lang('add_new'); ?></a></li>
                                </ul>
                            </li> 
                        <?php } ?>
					   <?php if ($this->ion_auth->in_group(array('Voter', 'Volunteer'))) { ?>

							  <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope-o"></i>
                                    <span>Notification</span>
                                </a>
                                <ul class="sub">
								<li><a  href="notice"><i class="fa fa-location-arrow"></i>Notice</a></li>
								<li><a  href="notification"><i class="fa fa-location-arrow"></i>Notification</a></li>
                       								<li><a  href="notice/message"><i class="fa fa-location-arrow"></i>Message</a></li>
                                </ul>
                            </li> 
		  
		  
		  
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope-o"></i>
                                    <span><?php echo lang('email'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="email/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>
                                    <li><a  href="email/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="email/settings"><i class="fa fa-gear"></i><?php echo lang('settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope-o"></i>
                                    <span><?php echo lang('sms'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="sms/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('write_message'); ?></a></li>
                                    <li><a  href="sms/sent"><i class="fa fa-list-alt"></i><?php echo lang('send_sms'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="sms/settings"><i class="fa fa-gear"></i><?php echo lang('sms_settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?>
						
						<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope-o"></i>
                                    <span><?php echo lang('whats_up'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="whatsup/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('view_template'); ?></a></li>
                                    <li><a  href="whatsup/sent"><i class="fa fa-list-alt"></i><?php echo lang('send_whatsup'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a  href="whatsup/settings"><i class="fa fa-gear"></i><?php echo lang('whatsip_settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>


                            <li> <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-cogs"></i>
                                    <span><?php echo lang('settings'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="settings"><i class="fa fa-gear"></i><?php echo lang('system_settings'); ?></a></li>
                                    <li><a href="settings/language"><i class="fa fa-wrench"></i><?php echo lang('language'); ?></a></li>
                                    <li><a href="settings/backups"><i class="fa fa-smile-o"></i><?php echo lang('backup_database'); ?></a></li>
									<li><a href="settings/userright"><i class="fa fa-gear"></i>Permissions</a></li>
									<li><a href="settings/ward"><i class="fa fa-smile-o"></i>Ward No</a></li>
									<li><a href="settings/cities"><i class="fa fa-smile-o"></i>City</a></li>
									<li><a href="settings/states"><i class="fa fa-smile-o"></i>States</a></li>
									
                                </ul>
                            </li>





                        <?php } ?>


                        <?php if ($this->ion_auth->in_group('superadmin')) { ?>

                            <li>
                                <a href="party">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('all_partys'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="party/addNewView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span><?php echo lang('create_new_party'); ?></span>
                                </a>
                            </li>
                        <?php } ?>


						 <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <li>
                            <a href="profile" >
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('profile'); ?> </span>
                            </a>
                        </li>
						 <?php } ?>
                        <!--multi level menu start-->

                        <!--multi level menu end-->

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->




