<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('team'); ?>  <?php echo lang('details'); ?> 
            </header>
            <div class="panel-body">
                <div class="col-md-3">
                    <section>
                        <div class="task-thumb-details">
                            <p><?php echo lang('team_name'); ?></p>
                            <h1><?php echo $team_details->name; ?></h1> <br><br>
                            <p><?php echo lang('team_location'); ?></p>
                            <h1><?php echo $team_details->area; ?></h1> <br><br>
                            <p><?php echo lang('team_task'); ?></p>
                            <h1><?php echo $team_details->task; ?></h1> <br>
                        </div>    
                    </section>
					<section>
                        <div class="task-thumb-details">
											<h3 style="color:#FCB322">Message Here</h3>
                <form action="team/addTeamconversation"  method="post" enctype="multipart/form-data">
					<div class="form-group col-md-12">
                        <label class="control-label col-md-12">Message</label>
                        <div class="col-md-12">
                            <textarea name="msg" value='' placeholder="type here...." rows="4"></textarea>
                        </div>
                    </div>
					<div class="form-group col-md-12">
                        <label class="control-label col-md-12">Attatchment</label>
                        <div class="col-md-12">
                            <input type="file" class="form-control" name="file[]" value='' placeholder="" multiple="multiple">
                        </div>
                    </div>
                    <input type="hidden" name="team_id" value='<?php echo $team_details->id; ?>'>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
                        </div>    
                    </section>
                </div>
                <div class="adv-table editable-table col-md-6">
                    <div class="clearfix">
					<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <a data-toggle="modal" href="#myModal">
						
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php echo lang('add_team_member'); ?>
                                </button>
                            </div>
                        </a>
					<?php } ?>
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('team_members'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $teammembers = explode(',', $team_details->members);
                            foreach ($teammembers as $teammember) {
                                if (is_numeric($teammember)) {
                                    $teammember = $this->db->get_where('volunteer', array("id" => $teammember))->row();
                                    ?>
                                    <tr class="">
                                        <td><?php echo $teammember->name; ?></td>
                                        <td><?php echo $teammember->email; ?></td>
                                        <td><?php echo $teammember->phone; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="team/deleteTeamMember?team_id=<?php echo $team_details->id; ?>&member_id=<?php echo $teammember->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
				<div class="col-md-3">
                    <section>
<style>
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: -8px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: -16px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
</style>
                        <div class="task-thumb-details">

	<div class="row" style="height: 636px;overflow-y: scroll;">
		<div class="col-md-12">
			<h4>Latest Task</h4>
			<ul class="timeline">
			<?php foreach($conversation_details as $timeline) { 
			$msgname = $this->db->get_where('users', array("id" => $timeline->created_by))->row();
			?>
				<li>
					<a target="_blank" href="#!"><?php echo $msgname->username; ?></a>&nbsp;&nbsp;
					<a href="#" class="float-right"><?php echo $timeline->created_date; ?></a></br>
					<?php if(!empty($timeline->file)){ 
					 
                            $fileextenstin=explode('||',$timeline->file);
							 foreach($fileextenstin as $filename){ 
                                                if(pathinfo($filename, PATHINFO_EXTENSION)=='mp4'||pathinfo($filename, PATHINFO_EXTENSION)=='mp3'||pathinfo($filename, PATHINFO_EXTENSION)=='avi'||pathinfo($filename, PATHINFO_EXTENSION)=='flv'||pathinfo($filename, PATHINFO_EXTENSION)=='wmv'||pathinfo($filename, PATHINFO_EXTENSION)=='mpeg'){
                                                ?>
							                     <video width="100" height="100" controls>
                                                      <source src="<?php echo base_url($filename); ?>" type="video/mp4">
                                                    </video> 
					                              <br>
							 
												<?php ?>
												 <?php }elseif(pathinfo($filename, PATHINFO_EXTENSION)=='jpg'||pathinfo($filename, PATHINFO_EXTENSION)=='png'||pathinfo($filename, PATHINFO_EXTENSION)=='gif'){?>
												  <img  src="<?php echo base_url($filename); ?>" width="100" height="100">
												   <br>
												<?php  }else{?>
												    <a href="<?php echo base_url($filename); ?>" width="100" height="100" target="_blank">Download</a>
							                           <br>
							 
					<?php }}} ?>
					<p><?php echo $timeline->msg; ?> </p>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
                        </div>    
                    </section>
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
                <h4 class="modal-title"><?php echo lang('add_team_member'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="team/addTeamMember" class="clearfix" method="post">  
                    <div class="col-md-9">
                        <select name="members[]" class="multi-select" multiple="multiple" id="my_multi_select3" >
                            <?php foreach ($volunteers as $volunteer) { ?>
                                <option value="<?php echo $volunteer->id; ?>"><?php echo $volunteer->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="team_id" value='<?php echo $team_details->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
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
                <h4 class="modal-title"><?php echo lang('edit_team'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="teamEditForm" action="team/addNew" method="post">
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('name'); ?></label>
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
                            <textarea class="ckeditor form-control" name="area" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('members'); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="members" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('task'); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="task" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <input type="hidden" name="id" value='<?php
                    if (!empty($team->id)) {
                        echo $team->id;
                    }
                    ?>'>
                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
                                                        $.ajax({
                                                            url: 'team/editTeamByJason?id=' + iid,
                                                            method: 'GET',
                                                            data: '',
                                                            dataType: 'json',
                                                        }).success(function (response) {
                                                            // Populate the form fields with the data returned from server
                                                            $('#teamEditForm').find('[name="id"]').val(response.team.id).end()
                                                            $('#teamEditForm').find('[name="name"]').val(response.team.name).end()
                                                            $('#teamEditForm').find('[name="area"]').text(response.team.area).end()
                                                            $('#teamEditForm').find('[name="members"]').val(response.team.members).end()
                                                            $('#teamEditForm').find('[name="task"]').text(response.team.task).end()
                                                            //   CKEDITOR.instances['editor1'].setData(html)

                                                            $('#myModal2').modal('show');
                                                        });

                                                    });
                                                });

</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
