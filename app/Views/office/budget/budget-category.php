<?=
	$this->extend('layouts/admin')
?>




<?= $this->section('content') ?>


<div class="container-fluid">
	
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
						<li class="breadcrumb-item active">Budget Categories</li>
					</ol>
				</div>
				<h4 class="page-title">Budget Categories</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card">
			<div class="card-body">
		
				<?php if(session()->has('action')): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
				<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
			</div>
		<?php endif; ?>
				
				
					<div>
						<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-bc" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Category</button>
					
					</div>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Category</th>
							<th>Action</th>
							
						</tr>
						</thead>
						
						
						<tbody>
						<?php if(!empty($categories)):
							$sn = 1;
							foreach ($categories as $category):
							?>
						<tr>
							<td><?=$sn++; ?></td>
							<td><?=$category['bc_name'] ?></td>
							<td><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-bc<?=$category['bc_id'] ?>" > <i class="mdi mdi-pen-lock mr-2"></i></button>
							</td>
						
						</tr>
						<?php endforeach;
						endif; ?>
				
						</tbody>
					</table>
				
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	
	<!-- end row -->
	


</div> <!-- container -->

<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-bc" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Budget Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Category's Name</label>
								<span class="form-note">Enter Category Name</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="bc_name" required>
								</div>
							</div>
						</div>
					</div>
				
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
								<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Long Content Scroll Modal -->
<?php foreach ($categories as $category): ?>
<div class="modal fade" id="edit-bc<?=$category['bc_id'] ?>" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">Update Budget Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Category's Name</label>
								<span class="form-note">Enter Category Name</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="bc_name" value="<?=$category['bc_name'] ?>" required>
								</div>
							</div>
						</div>
					</div>
					
					<input type="hidden" value="<?=$category['bc_id']; ?>" name="bc_id">
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
								<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach; ?>
<?= $this->endSection() ?>
