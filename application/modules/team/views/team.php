<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('team'); ?> 
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_team'); ?>
                            </button>
                        </div>
                    </a>
                </div>	
            </header>
 <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('team'); ?> <?php echo lang('name'); ?></th>
                                <th><?php echo lang('area'); ?></th>
                                <th><?php echo lang('members'); ?></th>
                                <th><?php echo lang('task'); ?></th>
								<th>Notifications</th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
$latestDatass = $this->team_model->getTeamlatest();
//print_r($latestDatass);exit;
$latestData = array();
if(!empty($latestDatass)){
    foreach($latestDatass as $tlsdata){
        $latestData[] = $tlsdata->team_id;
    }
}
?>
                            <?php  if ($this->ion_auth->in_group(array('admin'))) { foreach ($teams as $team) {
	
								?>

<?php if(in_array($team->id,$latestData)){ ?>
                                <tr class="" style="background:#6fcafb;">
                                    <td style="background:#6fcafb;"><?php echo $team->name; ?></td>
                                    <td style="background:#6fcafb;"><?php foreach($areas as $ward){
										if($team->area==$ward->id){
											$name=$ward->w_name;
									}
									} 
									echo $name; ?>
									</td>
                                    <td style="width: 50%;background:#6fcafb;">
                                        <?php
                                        if (!empty($team->members)) {
                                            $members = explode(',', $team->members);
                                            foreach ($members as $member) {
                                                if (is_numeric($member)) {
                                                    echo'<strong>' . $this->db->get_where('volunteer', array('id' => $member))->row()->name . '</strong>, ';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td style="background:#6fcafb;"><?php echo $team->task; ?></td>
									<td style="background:#6fcafb;font-size:20px;font-weight:900">
									<?php
                                        $this->db->where('created_date', date('Y-m-d'));
										$this->db->where('team_id', $team->id);
                                        $query = $this->db->get('tbl_conversation');
                                        $query = $query->result();
                                     echo   $num=count($query);
                                        ?>
									</td>
                                    <td style="background:#6fcafb;">
                                        <a href="team/teamdetails?team_id=<?php echo $team->id; ?>">  <button type="button" class="btn btn-info btn-xs btn_width">Details</button> </a>
                                        <button type="button" style="width: 35px;" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $team->id; ?>"><i class="fa fa-edit"></i></button> 
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="team/delete?id=<?php echo $team->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
<?php }else{ ?>
<tr class="">
                                    <td><?php echo $team->name; ?></td>
                                    <td><?php foreach($areas as $ward){
										if($team->area==$ward->id){
											$name=$ward->w_name;
									}
									} 
									echo $name; ?>
									</td>
                                    <td style="width: 50%;">
                                        <?php
                                        if (!empty($team->members)) {
                                            $members = explode(',', $team->members);
                                            foreach ($members as $member) {
                                                if (is_numeric($member)) {
                                                    echo'<strong>' . $this->db->get_where('volunteer', array('id' => $member))->row()->name . '</strong>, ';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $team->task; ?></td>
									<td></td>
                                    <td>
                                        <a href="team/teamdetails?team_id=<?php echo $team->id; ?>">  <button type="button" class="btn btn-info btn-xs btn_width">Details</button> </a>
                                        <button type="button" style="width: 35px;" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $team->id; ?>"><i class="fa fa-edit"></i></button> 
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="team/delete?id=<?php echo $team->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
<?php } ?>
							<?php }}else{ 
							 $this->db->select('volunteer.id as vid');
                             $this->db->from('volunteer');
		                     $this->db->join('users','users.email=volunteer.email');
							 $this->db->where('users.id', $this->session->userdata('user_id'));
							 $query=$this->db->get();
							 $id=$query->row()->vid;
							foreach ($teams as $team) {   
							  $members = explode(',', $team->members);
							  if(in_array($id,$members)){
							?>
<?php if(in_array($team->id,$latestData)){ ?>
							<tr class="" style="background:#6fcafb;">
                                    <td style="background:#6fcafb;"><?php echo $team->name; ?></td>
                                    <td style="background:#6fcafb;"><?php foreach($areas as $ward){
										if($team->area==$ward->id){
											$name=$ward->w_name;
									}
									} 
									echo $name; ?>
									</td>
                                    <td style="width: 50%;background:#6fcafb;">
                                        <?php
                                        if (!empty($team->members)) {
                                            $members = explode(',', $team->members);
                                            foreach ($members as $member) {
                                                if (is_numeric($member)) {
                                                    echo'<strong>' . $this->db->get_where('volunteer', array('id' => $member))->row()->name . '</strong>, ';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td style="background:#6fcafb;"><?php echo $team->task; ?></td>
									<td style="background:#6fcafb;font-size:20px;font-weight:900">
									<?php
                                        $this->db->where('created_date', date('Y-m-d'));
										$this->db->where('team_id', $team->id);
                                        $query = $this->db->get('tbl_conversation');
                                        $query = $query->result();
                                     echo   $num=count($query);
                                        ?>
									</td>
                                    <td style="background:#6fcafb;">
                                        <a href="team/teamdetails?team_id=<?php echo $team->id; ?>">  <button type="button" class="btn btn-info btn-xs btn_width">Details</button> </a>
                                        <button type="button" style="width: 35px;" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $team->id; ?>"><i class="fa fa-edit"></i></button> 
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="team/delete?id=<?php echo $team->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
<?php }else{ ?>	
<tr class="">
                                    <td><?php echo $team->name; ?></td>
                                    <td><?php foreach($areas as $ward){
										if($team->area==$ward->id){
											$name=$ward->w_name;
									}
									} 
									echo $name; ?>
									</td>
                                    <td style="width: 50%">
                                        <?php
                                        if (!empty($team->members)) {
                                            $members = explode(',', $team->members);
                                            foreach ($members as $member) {
                                                if (is_numeric($member)) {
                                                    echo'<strong>' . $this->db->get_where('volunteer', array('id' => $member))->row()->name . '</strong>, ';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $team->task; ?></td>
									<td></td>
                                    <td>
                                        <a href="team/teamdetails?team_id=<?php echo $team->id; ?>">  <button type="button" class="btn btn-info btn-xs btn_width">Details</button> </a>
                                        <button type="button" style="width: 35px;" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $team->id; ?>"><i class="fa fa-edit"></i></button> 
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="team/delete?id=<?php echo $team->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
<?php } ?>						
							
							  <?php }}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<!-- Add Team Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_team'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="team/addNew" class="clearfix" method="post" class="">
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('team'); ?> <?php echo lang('name'); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('area'); ?></label>
                        <div class="col-md-9">
                            <select class="form-control m-bot15" name="area" value=''> 
                                <?php foreach($areas as $ward){ ?>
                                    <option value="<?php echo $ward->id; ?>" ><?php echo $ward->w_name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('team'); ?> <?php echo lang('members'); ?></label>
                        <div class="col-md-9">
                            <select name="members[]" class="multi-select" multiple="multiple" id="my_multi_select3" >
                                <?php foreach ($volunteers as $volunteer) { ?>
                                    <option value="<?php echo $volunteer->id; ?>"><?php echo $volunteer->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>



                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3">Task</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="task" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Team Modal-->

<!-- Edit Team Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_team'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="teamEditForm" action="team/addNew" class="clearfix" method="post" class="">
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('team'); ?> <?php echo lang('name'); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3">Area</label>
                        <div class="col-md-9">
                            <select class="form-control m-bot15" name="area" value=''> 
                               <?php foreach($areas as $ward){ ?>
                                    <option value="<?php echo $ward->id; ?>" <?php if($team->area==$ward->id) {echo 'selected';} ?> ><?php echo $ward->w_name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('team'); ?> <?php echo lang('members'); ?></label>
                        <div class="col-md-9">
                            <select name="members[]" class="multi-select" multiple="multiple" id="my_multi_select3" >
                                <?php foreach ($volunteers as $volunteer) { ?>
                                    <option value="<?php echo $volunteer->id; ?>"><?php echo $volunteer->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>



                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('task'); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="task" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#teamEditForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'team/editTeamByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#teamEditForm').find('[name="id"]').val(response.team.id).end()
                                                    $('#teamEditForm').find('[name="name"]').val(response.team.name).end()
                                                    $('#teamEditForm').find('[name="area"]').val(response.team.area).end()
                                                    $('#teamEditForm').find('[name="members"]').val(response.team.members).end()
                                                    $('#teamEditForm').find('[name="task"]').val(response.team.task).end()

                                                    //  var dataarray = response.team.members.split(',');
                                                    //   $("#my_multi_select3").val(dataarray);
                                                    //  $("#my_multi_select3").multiselect("refresh");

                                                    var values = response.team.members;
                                                    $.each(values.split(","), function (i, e) {
                                                        $("#my_multi_select3 option[value='" + e + "']").prop("selected", true);
                                                    });


                                                });

                                            });
                                        });

</script>



<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });

</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

