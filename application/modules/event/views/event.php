<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('event_database'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_event'); ?>
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
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('organiser'); ?></th>
                                <th><?php echo lang('location'); ?></th>
                                <th><?php echo lang('contact'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('guests'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>
                        <?php foreach ($events as $event) { ?>
                            <tr class="">
                                <td> <?php echo $event->subject; ?></td>
                                <td> <?php echo $event->organiser; ?></td>
                                <td> <?php echo $event->location; ?></td>
                                <td><?php echo $event->contact; ?></td>
                                <td> <?php echo $event->date; ?> <br>
                                    <?php echo $event->s_time; ?> - <?php echo $event->e_time; ?>

                                    <?php
                                    if (strtotime($event->date) > time()) {
                                        echo '<p class="upcoming"> Upcoming </p>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $event->description; ?></td>
                                <td><?php echo $event->guests; ?></td>
                                <td>
                                 <!--   <a class="" href="event/eventDetails?id=<?php echo $event->id; ?>"><i class="fa fa details">details</i></a> -->
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $event->id; ?>"><i class="fa fa-edit"></i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="event/delete?id=<?php echo $event->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
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

<!-- Add Event Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_new_event'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="event/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="subject" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_organiser'); ?></label>
                        <input type="text" class="form-control" name="organiser" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_location'); ?></label>
                        <input type="text" class="form-control" name="location" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_contact_number'); ?></label>
                        <input type="text" class="form-control" name="contact" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="date" value="" placeholder="">
                    </div>
                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        </div>
                        <div class="col-md-6"> 
                            <div class="">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value="" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        </div>
                        <div class="col-md-6"> 
                            <div class="">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value="" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description"  id="exampleInputEmail1" placeholder="" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('guests'); ?></label>
                        <input type="text" class="form-control" name="guests" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_event'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editEventForm" action="event/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="subject" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_organiser'); ?></label>
                        <input type="text" class="form-control" name="organiser" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_location'); ?></label>
                        <input type="text" class="form-control" name="location" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('event_contact_number'); ?></label>
                        <input type="text" class="form-control" name="contact" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="date" value="" placeholder="">

                    </div>
                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        </div>
                        <div class="col-md-6"> 
                            <div class="">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value="" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        </div>
                        <div class="col-md-6"> 
                            <div class="">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value="" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description"  id="exampleInputEmail1" placeholder="" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('guests'); ?></label>
                        <input type="text" class="form-control" name="guests" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value='<?php
                    if (!empty($event->id)) {
                        echo $event->id;
                    }
                    ?>'>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editEventForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'event/editEventByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editEventForm').find('[name="id"]').val(response.event.id).end()
                                                //   $('#editEventForm').find('[name="p_id"]').val(response.client.client_id).end()
                                                $('#editEventForm').find('[name="area"]').val(response.event.area).end()
                                                $('#editEventForm').find('[name="organiser"]').val(response.event.organiser).end()
                                                $('#editEventForm').find('[name="location"]').val(response.event.location).end()
                                                $('#editEventForm').find('[name="contact"]').val(response.event.contact).end()
                                                $('#editEventForm').find('[name="date"]').val(response.event.date).end()
                                                $('#editEventForm').find('[name="s_time"]').val(response.event.s_time).end()
                                                $('#editEventForm').find('[name="e_time"]').val(response.event.e_time).end()
                                                $('#editEventForm').find('[name="subject"]').val(response.event.subject).end()
                                                $('#editEventForm').find('[name="description"]').val(response.event.description).end()
                                                $('#editEventForm').find('[name="guests"]').val(response.event.guests).end()
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
                        columns: [0, 1, 2, 3, 4, 5, 6],
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