<?php
	require_once('includes/common.php');
	require_once('includes/header.php');
	require_once('includes/nav.php');
	require_once('includes/database.php');

	$page = "Assets";
	


	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if (empty($_POST["id"])) {
			newDBItem($_POST,$page);
		}else{
			//echo "setting db item<\br>";
		setDBItem($_POST,$page);
	}
		foreach($_FILES as $file){

			$target_dir = "uploads/";
			$target_file = $target_dir . basename($file["name"]);

			if (move_uploaded_file($file["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $file["name"]). " has been uploaded.";
		    } else {
		        //echo "Sorry, there was an error uploading your file.";
		    }
		}

	}

	$completedTabs = [];

	$dbItems = getDBItems($page);
	$fields = getFields($page);

	$tabs = array_keys($fields);
	function glob_recursive($directory, &$directories = array()) {
        foreach(glob($directory, GLOB_ONLYDIR | GLOB_NOSORT) as $folder) {
            $directories[] = $folder;
            glob_recursive("{$folder}/*", $directories);
        }
    }
	function findFiles($directory, $extensions = array()) {
	    
	    glob_recursive($directory, $directories);
	    $files = array ();
	    foreach($directories as $directory) {
	        foreach($extensions as $extension) {
	            foreach(glob("{$directory}/*.{$extension}") as $file) {
	                array_push($files, $file);
	            }
	        }
	    }
	    return $files;
	}

	$imageFiles = findFiles("./uploads", array (
	    "jpg",
	    "png"
	));

//	echo "<pre>";
//	       var_dump($tabs);
//	echo "</pre>";


?>
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="">
                        <div class="page-header-title">
                            <h4 class="page-title"><?php echo $page; ?></h4>
                        </div>
                    </div>
                    <div class="page-content-wrapper ">
                        <div class="container">
                            <div class="row">
                                <div id="asset-list" class="col-sm-6">
									<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Quick Add</h4>
											</div>
											<div class="panel-body text-center">
												<form class="form-inline form-group" role="form" id="quickForm" action="" method="post" enctype="multipart/form-data">
													<div class="form-group m-l-10"> 
														<label class="sr-only" for="exampleInputEmail2">Name</label> 
														<input placeholder="Enter Name" id="quickAdd" Name="Name" type="text" required="required" class="form-control">
													</div>
													<div class="form-group m-l-10">
														<button type="submit" class="btn btn-primary btn-lg waves-effect waves-light m-l-10" value="submit" name="submit">Add Asset</button>
													</div> 
												</form>
											</div>
										</div>
									</div>
								<div class="col-sm-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">Add New Asset</h4>
										</div>
										<div class="panel-body text-center">
											<form class="form-inline form-group">
												<div class="form-group m-l-10">
												<a href="#modal1" class="btn btn-primary btn-lg waves-effect waves-light m-l-10">Create Asset</a>
												</div>
											</form>
										</div>
									</div>	
								</div>
								</div>
                            </div><!-- end row ADDS-->                     
                        </div><!-- Add Asset container -->

                        <div id="asset-list" class="container col-8">
                        	<div class="row">
                        		
                        	</div>
                        </div> <!-- AssetList Container -->

                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="list-group text-center">
                        			<?php foreach ($dbItems as $dbItem) { ?>
                        				<a href="#modal1" id="btn-default-<?php echo $dbItem->id; ?>" class="list-group-item" onclick="getDBItem(<?php echo $dbItem->id . ",'" . $page . "'"; ?>)">
                        					<h5 class="left asset-label valign"> <?php echo $dbItem->name; ?></h5>
                        				</a>

                        			<?php } ?>
                        		</div>
                        	</div>
                        	
                        </div>
					</div> <!-- Page content Wrapper -->
                </div> <!-- content -->
		  <!-- Modal Structure -->
		 <div id="modal1" class="modal full-screen">
		 <form id="itemForm" action="" method="post" enctype="multipart/form-data">
		 	<input id="id" name="id" type="hidden" />
			<div class="nav-content">
		      <ul class="nav nav-tabs tabs">
		      <?php foreach($tabs as $tab) { ?>

		        <li class="tab"><a class="" href='<?php echo "#" . friendly($tab); ?>' ><?php echo $tab; ?></a></li>
		        <?php } ?>
		        <li class="tab"><a class="" href='#checklist' >Check List</a></li>
		      </ul>
		    </div>

		    <?php foreach($tabs as $tab) { ?>
			<div id="<?php echo friendly($tab); ?>" class="modal-content">
				<div class="modal-body">
	      	 		<div class="row">

			    		<div class="col-xs-12">
			    			<div class="row">
			    				<?php 
			      	 				if(friendly($tab) == "General") {
			      	 			?>
			      	 				<!-- Start of carousel --> 
								    <div id="myCarousel" class="carousel slide" data-ride="carousel">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
									    <?php 
								    	$i=0;
									  	foreach($imageFiles as $file) { ?>
									  		<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if($i==0) echo "class='".active."'"; ?>></li>
									  		
									  	<?php 
									  		$i++;
									  	} 
									  	?>
									  </ol>

									  <!-- Wrapper for slides -->
									  <div class="carousel-inner">
									  	<?php 
									  	$index=0;
									  	foreach($imageFiles as $file) { ?>
									  		<div class="item<?php if($index==0) echo " active"; ?>">
										      <img src="<?php echo $file; ?>">
										    </div>
									  	<?php 
									  		$index++;
									  	} 
									  	?>
									  </div>

									  <!-- Left and right controls -->
									  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
									    <span class="glyphicon glyphicon-chevron-left"></span>
									    <span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#myCarousel" data-slide="next">
									    <span class="glyphicon glyphicon-chevron-right"></span>
									    <span class="sr-only">Next</span>
									  </a>
									</div>
									<!-- End of Carousel -->
			      	 				<?php
			      	 			}
			      	 			?>
			    			</div>
			      			<div class="row">
			      				<?php foreach ($fields[$tab] as $field){ 
			      					if((is_array($field))){
			      						//this means that we have found subtabs list grab them.
			      					if(!in_array($tab, $completedTabs)){
			      						$completedTabs[] = $tab;
			      						$subTabs = array_keys($fields[$tab]);

			      						//var_dump($subTabs);
			      						?>
			      						<div class="nav-content">
									      <ul class="nav nav-tabs tabs">
									      <?php foreach($subTabs as $subTab) { ?>

									        <li class="tab"><a class="form-control" href='<?php echo "#" . friendly($subTab); ?>' ><?php echo $subTab; ?></a></li>
									        
									        <?php } ?>
									      </ul>
									    </div>

									    <?php foreach($subTabs as $subTab) { ?>
											<div id="<?php echo friendly($subTab); ?>" >
									    		<div class="col-sm-12">
									      			<div class="row modal-body">
										<?php 

											foreach ($fields[$tab][$subTab] as $field){
												if($field->type=="File"){ 
			      							?>
			      								
				      								<div class="form-group">
												    	<a class="btn bnt-default" id="<?php echo friendly($field->name) . "_get"; ?>" href="" ><i class="">file_download</i></a>
				      									<div class="form-group">
													      	<div class="btn btn-default">
													        	<span>File</span>
													        	<input name="<?php echo friendly($field->name) . "_file"; ?>" id="<?php echo friendly($field->name) . "_file"; ?>" type="file">
													      	</div>

												      	<div class="form-group">
												        <input name="<?php echo friendly($field->name) . ""; ?>" id="<?php echo friendly($field->name) . ""; ?>" class="form-control" type="text">
												      	</div>
												    </div>
											    
											    <div class="form-group">
												    <div class="clear"></div>
												    </div>
												</div>
											</div>
	      							<?php
			      						}elseif($field->type=="Select"){
			      								?>
				  
				      						<div class=" form-group col-<?php  
					      						if($field->width === "Full"){
					      							echo "sm-12";
					      						}elseif($field->width === "Half"){
					      							echo "md-6 col-xs-12";
					      						}else{
					      							echo "md-4 col-xs-12";
					      						}
					      						?>">
					      						<?php if($field->related != false){ ?>

					      						<a class="btn btn-primary" id="<?php echo friendly($field->name) . "_go"; ?>" href="<?php if($field->related = "Tenants"){echo "tenant.php#item-[id]";}; ?>" >search</a>
					      						
					          					
					          			

					          					<?php }else{ ?>
					          							<select name="<?php echo $field->name; ?>" id="<?php echo friendly($field->name); ?>" class="form-control">

					          							<?php	} ?>

						          						<?php
						          						foreach ($field->choices as $key=>$choice) {
						          							?>   <option value="<?php echo $key; ?>"><?php echo $choice; ?></option>   <?php
						          						}
						          						?>
					          					</select>
					          					<label for="<?php echo friendly($field->name); ?>"><?php echo $field->name; ?></label>

				        					</div>
				        				


			        


			      				<?php 
			      						}


					      						else{

					      					?>
						      					
						      					<div class="input-field form-group col-<?php  if($field->width === "Full"){
						      							echo "sm-12";
						      						}elseif($field->width === "Half"){
						      							echo "md-6 col-xs-12";
						      						}else{
						      							echo "md-4 col-xs-12";
						      						} ?>">
						      						<!--<label for="<?php echo friendly($field->name); ?>"><?php echo $field->name; ?></label>-->
						          					<input name="<?php echo friendly($field->name); ?>" id="<?php echo friendly($field->name); ?>" type="text" class="form-control">
						          					<label for="<?php echo friendly($field->name); ?>"><?php echo $field->name; ?></label>
						        					</div>
						        			
					      				<?php }	

													}

							
												 ?>

												 </div>
												 </div>
												 </div>

											    <?php
											}
											}


					      					}else{

					      						if($field->type=="File"){ 
					      							?>
													<div class="row container-fluid form-group">
					      									<div class="file-field mcfile bootstrap-filestyle input-group">
													        	<input name="<?php echo friendly($field->name) . "_file"; ?>" id="<?php echo friendly($field->name) . "_file"; ?>" type="file" class="file-button form-control" style="display: none;">
													        	<input name="<?php echo friendly($field->name) . ""; ?>" id="<?php echo friendly($field->name) . ""; ?>" class="form-control border-field file-path validate" type="text">

													        	<span class="group-span-filestyle input-group-btn btn-primary" tabindex="0">
					      										<label for="<?php echo friendly($field->name) . "_file"; ?>" class="btn btn-primary ">
					      											<span class="icon-span-filestyle glyphicon glyphicon-folder-open">
					      												
					      											</span>
					      											 <span class="buttonText">
					      											 	Choose file
					      											 </span>
					      											</label>
					      										</span>
													    	</div>													    
													</div>

					      							<?php
					      						}elseif($field->type=="Select"){
					      								?>

					      						<div class="form-group input-field col-<?php  
						      						if($field->width === "Full"){
						      							echo "sm-12";
						      						}elseif($field->width === "Half"){
						      							echo "md-6 col-xs-12";
						      						}else{
						      							echo "md-4 col-xs-12";
						      						}
						      						?>">
						      						<?php if($field->related != false){ ?>

						      							<a class="btn btn-primary" id="<?php echo friendly($field->name) . "_go"; ?>" href="<?php if($field->related = "Tenants"){echo "tenant.php#item-[id]";}; ?>" ><i class="material-icons">search</i></a>
						      						
						          						<select name="<?php echo friendly($field->name); ?>" id="<?php echo friendly($field->name); ?>" class="form-control">
						          					<?php }else{ ?>
						          						<select name="<?php echo friendly($field->name); ?>" id="<?php echo friendly($field->name); ?>" class="form-control">
							          					<?php	} ?>
							          						<?php
							          						foreach ($field->choices as $key=>$choice) {
							          							?>   <option value="<?php echo $key; ?>"><?php echo $choice; ?></option><?php } ?>
						          						</select>
						          					<label for="<?php echo friendly($field->name); ?>"><?php echo $field->name; ?></label>
					        					</div>
					      				<?php 
					      						}
					      						else{

					      					?>
					      			
					      					<div class="input-field form-group col-<?php  if($field->width === "Full"){
					      							echo "sm-12";
					      						}elseif($field->width === "Half"){
					      							echo "md-6 col-xs-12";
					      						}else{
					      							echo "md-4 col-xs-12";
					      						} ?>">
					          					<input name="<?php echo friendly($field->name); ?>" id="<?php echo friendly($field->name); ?>" type="text" class="form-control">
					          					<label for="<?php echo friendly($field->name); ?>"><?php echo $field->name; ?></label>
					        					</div>
					        			
					      				<?php }	}

					      				 } ?>
					      			</div>
					      		</div>
					      	</div>
				      	</div>
				     </div>


		      <?php }

		      //here is where I need to create the checklist portion

		      ?>
		      <div id="checklist" class="modal-content">
      	 		<div class="row modal-body">
		    		<div class="col-xs-12"></div>

		    			<?php foreach($tabs as $tab) { ?>
		    			<div class="col-xs-12 checklist-title"><?php echo $tab; ?></div>
		    			<hr/>

		    			<?php foreach ($fields[$tab] as $field){ 
		      					if((is_array($field))){ 
		      						foreach( $field as $subField){
		      							?>
		      								<div class="col-sm-4 col-xs-12" id="check-<?php  echo friendly($subField->name); ?>">
		      									<?php echo $subField->name; ?>
		      									
		      								</div>
		      							<?php

		      						}
										?>

		      					<?php }else { ?>

		      						<div class="col-sm-4 col-xs-12" id="check-<?php  echo friendly($field->name); ?>"><?php echo $field->name; ?></div>


		      					<?php	} ?>

		    			<?php }
		    			 ?><div class="clear"></div>
		    			<?php } ?>

		    	</div>
			</div>
		    <div class="modal-footer">
		     	 <a href="" class="btn btn-primary">Close</a>
		     	 <button type="submit" class="btn btn-success" value="submit" name="submit">Submit</button>
		    </div>
		    </form>
		 </div>

		</div>
	</div>
</div>


<?php
	require_once('includes/footer.php');
?>

<script>
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('#modal1').modal();
  });
</script>