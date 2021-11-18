<section id="main-content">
    <section class="wrapper site-min-height">
<div class="container">

            <style>

body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 200px;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;

}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}


            </style>
			
		
</div>
                               <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="<?php echo base_url().$voter->img_url;?>" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Profile Photo
                            </div>
                        </div>
						<div class="profile-img">
                            <img src="<?php echo base_url().$voter->voter_id_card;?>" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Voter Id Photo
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
									     <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">User Details</a>
                                </li>
                            </ul>
							<div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->name; ?></p>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->email; ?></p>
                                            </div>
                                        </div>
									<div class="row">
                                            <div class="col-md-6">
                                                <label>Voter Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->voter_id; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>D.O.B</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->birthdate; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Ward No</label>
                                            </div>
                                            <div class="col-md-6">
											<?php foreach ($all_ward as $vot) { 
											if($voter->ward_no==$vot->id){
												$ward=$vot->w_name;
											}
											?>
                                  
                                                        <?php } ?>
                                                <p><?php echo $ward; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->vphone; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Age</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->age; ?></p>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->address; ?></p>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <label>Sex</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->sex; ?></p>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <label>Marital Status</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->marital_status; ?></p>
                                            </div>
                                        </div>
										<?php if($voter->universary_date!=''){ ?>
										<div class="row">
                                            <div class="col-md-6">
                                                <label>Anniversary Date</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $voter->universary_date; ?></p>
                                            </div>
                                        </div>
										<?php } ?>
                            </div>
                    </div>
                    <div class="col-md-2">
 <a href="<?php echo base_url(); ?>profile/edit_profile" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </form>           
        </div>
               </div>              
         </section>
  </section>
  <script>
  function gethide() {
document.getElementById('myModal').style.display = 'none';
}
function unirveser_date(id) {
	if(id==='Married'){
document.getElementById('Anniversary').style.display = 'Block';
}else{
	document.getElementById('Anniversary').style.display = 'none';
}}
  </script>