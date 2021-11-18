<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('added_list') ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('added_qr'); ?>
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
                                <th> <?php echo lang('name') ?></th>
                                <th> Assign to</th>
								<th> <?php echo lang('qr_code') ?></th>
                                <th class="no-print"> <?php echo lang('options') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($areas as $area) { ?>
                                <tr class="">
                                    <td><?php echo $area->name; ?></td>
                                    <td><?php echo $area->created_by; ?></td>
									<td><a href="<?php echo $area->qr_url; ?>" target="_blank"><img  height="100px"  width="100px" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $area->qr_url?>&choe=UTF-8" /></a></td>
                                    <td class="no-print">
                                       <!--- <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $area->id; ?>"><i class="fa fa-edit"></i> </button>   
                                       -->
									   <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="qrcode/delete?id=<?php echo $area->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Area Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('added_qr') ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="qrcode/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('qr_name') ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class=""> <?php echo lang('qr_assign') ?></label>
                        <div class="">
						
						  <select class="form-control m-bot15" name="qr_assign" value=''> 
                                                <?php foreach ($user_list as $user) { ?>
                                                    <option value="<?php echo $user->uid; ?>"><?php echo $user->name; ?> </option>
                                                <?php } ?>
                                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Area Modal-->

<!-- Edit Area Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('edit_qr') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="areaEditForm" class="clearfix" action="area/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                           <label for="exampleInputEmail1"> <?php echo lang('qr_name') ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                                 <label class=""> <?php echo lang('qr_assign') ?></label>
                         <select class="form-control m-bot15" name="qr_assign" value=''> 
                                                <?php foreach ($user_list as $user) { ?>
                                                    <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?> </option>
                                                <?php } ?>
                                            </select>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'qrcode/editAreaByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#areaEditForm').find('[name="id"]').val(response.area.id).end()
                                                    //$('#areaEditForm').find('[name="name"]').val(response.area.name).end()
                                                    CKEDITOR.instances['editor'].setData(response.area.description)
                                                    $('#myModal2').modal('show');
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,

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
            iDisplayLength: -1,
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
