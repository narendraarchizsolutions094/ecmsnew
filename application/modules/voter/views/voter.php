<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <?php echo lang('voter'); ?> <?php echo lang('database'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="voter/voterDetails">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
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
                                <th><input type="checkbox" class="checked_all1" value="Check_all"></th>
                                <th><?php echo lang('voter_id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                 <th><?php echo lang('added_by'); ?></th>
								 <th><?php echo lang('created_date'); ?></th>
								 <th><?php echo lang('updated_date'); ?></th>
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






<!-- Add Voter Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('register_new_voter'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="voter/addNew" class="clearfix" method="post" enctype="multipart/form-data">




                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('voter_id'); ?></label>
                        <input type="text" class="form-control" name="voter_id" id="exampleInputEmail1" value='' placeholder="">
                    </div>



                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('area'); ?></label>
                        <select class="form-control js-example-basic-single"  name="area" value=''> 
                            <option value=""> </option>
                            <?php foreach ($areas as $area) { ?>                                        
                                <option value="<?php echo $area->name; ?>"><?php echo $area->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''> 
                            <?php foreach ($categorys as $category) { ?>
                                <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?> </option>
                            <?php } ?>
                        </select>
                    </div>




                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                        <select class="form-control m-bot15" name="contacted" value=''>
                            <option value="Yes" <?php
                            if (!empty($voter->contacted)) {
                                if ($voter->contacted == 'Yes') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('yes'); ?> </option>
                            <option value="No" <?php
                            if (!empty($voter->contacted)) {
                                if ($voter->contacted == 'No') {
                                    echo 'selected';
                                }
                            }
                            ?> selected> <?php echo lang('no'); ?> </option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($voter->bloodgroup)) {
                                    if ($group->group == $voter->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>





                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--
                                        <div class="form-group last col-md-6">
                                            <div style="text-align:center;" class="col-md-12">
                                                <video id="video" width="200" height="200" autoplay></video>
                                                <div class="snap" id="snap">Capture Photo</div>
                                                <canvas id="canvas" width="200" height="200"></canvas>
                                                Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                                            </div>
                                        </div>
                    -->


                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>


                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Voter Modal-->







<!-- Edit Voter Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_voter'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editVoterForm" action="voter/addNew" class="clearfix" method="post" enctype="multipart/form-data">


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('voter_id'); ?></label>
                        <input type="text" class="form-control" name="voter_id" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('area'); ?></label>
                        <select class="form-control js-example-basic-single area"  name="area" value=''> 
                            <option value=""> </option>
                            <?php foreach ($areas as $area) { ?>                                        
                                <option value="<?php echo $area->name; ?>"><?php echo $area->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('voter_category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''> 
                            <?php foreach ($categorys as $category) { ?>
                                <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?> </option>
                            <?php } ?>
                        </select>
                    </div>




                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                        <select class="form-control m-bot15" name="contacted" value=''>
                            <option value="Yes" <?php
                            if (!empty($voter->contacted)) {
                                if ($voter->contacted == 'Yes') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('yes'); ?> </option>
                            <option value="No" <?php
                            if (!empty($voter->contacted)) {
                                if ($voter->contacted == 'No') {
                                    echo 'selected';
                                }
                            }
                            ?> selected> <?php echo lang('no'); ?> </option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($voter->sex)) {
                                if ($voter->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>





                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($voter->bloodgroup)) {
                                    if ($group->group == $voter->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>





                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!--
                    
                    <div class="form-group last col-md-6">
                        <div style="text-align:center;">
                            <video id="video" width="200" height="200" autoplay></video>
                            <div class="snap" id="snap">Capture Photo</div>
                            <canvas id="canvas" width="200" height="200"></canvas>
                            Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                        </div>
                    </div>
                    
                    -->








                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($voter->voter_id)) {
                        echo $voter->voter_id;
                    }
                    ?>'>





                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit Voter Modal-->












<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('voter'); ?>  <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editVoterForm" action="voter/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('voter_id'); ?>: <span class="voterIdClass"></span></label>
                            </div>
                        </div>

                    </div>


                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>     
                    </div>






                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                        <label for="exampleInputEmail1"><?php echo lang('area'); ?></label>
                        <div class="areaClass"></div>
                    </div>
                    <div class="form-group col-md-4">    
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <div class="categoryClass"></div>
                    </div>
                    <div class="form-group col-md-4">    
                        <label for="exampleInputEmail1"><?php echo lang('contacted'); ?></label>
                        <div class="contactedClass"></div>
                    </div>







                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>

<!--
<script>


    var video = document.getElementById('video');
    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function () {
        context.drawImage(video, 0, 0, 200, 200);
    });

</script>

-->



<script type="text/javascript">

    $(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-voter-icon-vector-6244713.jpg");
        $('#editVoterForm').trigger("reset");
        $.ajax({
            url: 'voter/editVoterByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('#editVoterForm').find('[name="id"]').val(response.voter.id).end()
            $('#editVoterForm').find('[name="voter_id"]').val(response.voter.voter_id).end()
            $('#editVoterForm').find('[name="name"]').val(response.voter.name).end()
            $('#editVoterForm').find('[name="password"]').val(response.voter.password).end()
            $('#editVoterForm').find('[name="email"]').val(response.voter.email).end()
            $('#editVoterForm').find('[name="address"]').val(response.voter.address).end()
            $('#editVoterForm').find('[name="phone"]').val(response.voter.phone).end()
            $('#editVoterForm').find('[name="category"]').val(response.voter.category).end()
            $('#editVoterForm').find('[name="contacted"]').val(response.voter.contacted).end()
            $('#editVoterForm').find('[name="sex"]').val(response.voter.sex).end()
            $('#editVoterForm').find('[name="birthdate"]').val(response.voter.birthdate).end()
            $('#editVoterForm').find('[name="bloodgroup"]').val(response.voter.bloodgroup).end()
            $('#editVoterForm').find('[name="p_id"]').val(response.voter.voter_id).end()

            if (typeof response.voter.img_url !== 'undefined' && response.voter.img_url != '') {
                $("#img").attr("src", response.voter.img_url);
            }


            $('.js-example-basic-single.area').val(response.voter.area).trigger('change');

            $('#myModal2').modal('show');

        });
    });

</script>



<script type="text/javascript">

    $(".table").on("click", ".inffo", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $("#img1").attr("src", "uploads/cardiology-voter-icon-vector-6244713.jpg");
        $('.voterIdClass').html("").end()
        $('.nameClass').html("").end()
        $('.emailClass').html("").end()
        $('.addressClass').html("").end()
        $('.phoneClass').html("").end()
        $('.genderClass').html("").end()
        $('.birthdateClass').html("").end()
        $('.bloodgroupClass').html("").end()
        $('.vidClass').html("").end()
        $('.areaClass').html("").end()
        $('.ageClass').html("").end()
        $('.categoryClass').html("").end()
        $('.contactedClass').html("").end()
        $.ajax({
            url: 'voter/getVoterByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('.voterIdClass').append(response.voter.voter_id).end()
            $('.nameClass').append(response.voter.name).end()
            $('.emailClass').append(response.voter.email).end()
            $('.addressClass').append(response.voter.address).end()
            $('.phoneClass').append(response.voter.phone).end()
            $('.genderClass').append(response.voter.sex).end()
            $('.birthdateClass').append(response.voter.birthdate).end()
            $('.ageClass').append(response.age).end()
            $('.bloodgroupClass').append(response.voter.bloodgroup).end()
            $('.vidClass').append(response.voter.voter_id).end()
            $('.categoryClass').append(response.voter.category).end()
            $('.contactedClass').append(response.voter.contacted).end()

            $('.areaClass').append(response.voter.area).end()

            if (typeof response.voter.img_url !== 'undefined' && response.voter.img_url != '') {
                $("#img1").attr("src", response.voter.img_url);
            }


            $('#infoModal').modal('show');

        });
    });

</script>





<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "voter/getVoter",
                type: 'POST',
            },
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
                        columns: [0, 1, 2],
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
   $('.checked_all1').on('change', function() {
      $('.checkbox1').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox1').change(function(){
   if($('.checkbox1:checked').length == $('.checkbox1').length){
         $('.checked_all1').prop('checked',true);
   }else{
         $('.checked_all1').prop('checked',false);
   }
   });
</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>



