
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> 
                <?php echo lang('donation'); ?> 
                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                    <div class="col-md-4 no-print pull-right"> 
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group pull-right">
                                <button id="" class="btn green btn-xs">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_donation'); ?>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('id'); ?></th>
                                <th><?php echo lang('donor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('type'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

                        <?php foreach ($donations as $donation) { ?>
                            <tr class="">
                                <td><?php echo $donation->id; ?></td>
                                <td><?php echo $this->donor_model->getDonorById($donation->donor)->name; ?></td>
                                <td><?php echo date('d-m-y', $donation->date); ?></td>
                                <td><?php echo $donation->type; ?></td>
                                <td class="center"><?php echo $settings->currency; ?><?php echo $donation->amount; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $donation->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="donation/delete?id=<?php echo $donation->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
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







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_donation'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="donation/addDonation" class="clearfix col-md-12" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('door'); ?></label>
                            <select class="form-control js-example-basic-single area"  name="type" value=''>                                       
                                <option value="cash"> <?php echo lang('cash'); ?> </option>
                                <option value="cheque"> <?php echo lang('cheque'); ?> </option>
                                <option value="others"> <?php echo lang('others'); ?> </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                        <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_donation'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editDonationForm" class="clearfix col-md-12" action="donation/addDonation" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('donor'); ?></label>
                        <select class="form-control js-example-basic-single area"  name="donor" value=''> 
                            <option value=""> </option>
                            <?php foreach ($donors as $donor) { ?>                                        
                                <option value="<?php echo $donor->id; ?>" <?php
                                if (!empty($donation->id)) {
                                    if ($donor->id == $donation->donor) {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo $donor->name; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('door'); ?></label>
                            <select class="form-control js-example-basic-single area"  name="type" value=''>                                       
                                <option value="cash"> <?php echo lang('cash'); ?> </option>
                                <option value="cheque"> <?php echo lang('cheque'); ?> </option>
                                <option value="others"> <?php echo lang('others'); ?> </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                        <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
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
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editDonationForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'donation/editDonationByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                var de = response.donation.date * 1000;
                                                var d = new Date(de);
                                                var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                                                // Populate the form fields with the data returned from server
                                                $('#editDonationForm').find('[name="id"]').val(response.donation.id).end()
                                                $('#editDonationForm').find('[name="donor"]').val(response.donation.donor).end()
                                                $('#editDonationForm').find('[name="date"]').val(da).end()
                                                $('#editDonationForm').find('[name="type"]').val(response.donation.type).end()
                                                $('#editDonationForm').find('[name="amount"]').val(response.donation.amount).end()
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
                        columns: [0, 1, 2, 3, 4, 5, 6],
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
