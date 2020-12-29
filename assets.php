﻿<?php
require_once 'includes/library.php';
session_start();
$app = new AppLib();
$is_login = $app->is_user();
$dbh = Database();
if (!$is_login) {
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="Dreamguys - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Assets - HaRaM</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="assets/css/line-awesome.min.css">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/css/select2.min.css">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<?php
		// <!-- Header -->
		include_once 'includes/header.php';
		// <!-- /Header -->
		// <!-- Sidebar -->
		include_once 'includes/sidebar.php';
		// <!-- /Sidebar -->
		?>
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<!-- Page Content -->
			<div class="content container-fluid">
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title">Assets</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
								<li class="breadcrumb-item active">Assets</li>
							</ul>
						</div>
						<div class="col-auto float-right ml-auto">
							<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<!-- Search Filter -->
				<div class="row filter-row">
					<div class="col-sm-6 col-md-3">
						<div class="form-group form-focus">
							<input type="text" class="form-control floating">
							<label class="focus-label">Employee Name</label>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group form-focus select-focus">
							<select class="select floating">
								<option value=""> -- Select -- </option>
								<option value="0"> Pending </option>
								<option value="1"> Approved </option>
								<option value="2"> Returned </option>
							</select>
							<label class="focus-label">Status</label>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group form-focus">
									<div class="cal-icon">
										<input class="form-control floating datetimepicker" type="text">
									</div>
									<label class="focus-label">From</label>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group form-focus">
									<div class="cal-icon">
										<input class="form-control floating datetimepicker" type="text">
									</div>
									<label class="focus-label">To</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-2">
						<a href="#" class="btn btn-success btn-block"> Search </a>
					</div>
				</div>
				<!-- /Search Filter -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 dataTable">
								<thead>
									<tr>
										<th class="text-left">Asset User</th>
										<th class="text-left">Asset Name</th>
										<th class="text-left">Asset Id</th>
										<th class="text-left">Purchase Date</th>
										<th class="text-left">Warrenty</th>
										<th class="text-left">Amount</th>
										<th class="text-center">Status</th>
										<th class="text-danger text-right">Setting</th>
									</tr>
								</thead>
								<!-- code to show the table -->

								<?php
								$sql = "SELECT * FROM assets";
								// $query = $dbh->prepare($sql);
								// $query->execute();
								// $results = $query->fetchAll(PDO::FETCH_OBJ);
								$results2 = $dbh->query($sql);
								$cnt = 1;
								if ($results2->rowCount() > 0) {
									foreach ($results2 as $row) {
										$newdate = date("l d-m-Y", strtotime($row['PurchaseDate'])); //Convert to d/m/Y
								?>
										<tbody>
											<tr>
												<td><?php echo htmlentities($row['AssetUser']); ?></td>
												<td>
													<strong><?php echo htmlentities($row['assetName']); ?></strong>
												</td>
												<td><?php echo htmlentities($row['assetId']); ?></td>
												<td><?php echo htmlentities($row['PurchaseDate']); ?></td>
												<td><?php echo htmlentities($row['Warranty']), " Months"; ?></td>
												<td><?php echo "Rp " . number_format((htmlentities($row['Price'])), 2, ',', '.'); ?></td>
												<td class="text-center">
													<div class="dropdown action-label">
														<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
															<i class="fa fa-dot-circle-o text-danger"></i> Pending
														</a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Pending</a>
															<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
															<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Returned</a>
														</div>
													</div>
												</td>
												<td class="text-right">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_asset"><i class="fa fa-pencil m-r-5"></i> Edit</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
								<?php $cnt += 1;
									}
								} ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->
			<!-- Add Asset Modal -->
			<?php
			// adding assets begins here
			if (isset($_POST['add_asset'])) {
				$asset = htmlspecialchars($_POST['asset_name']);
				$asset_id = htmlspecialchars($_POST['asset_id']);
				$purchase_date = htmlspecialchars($_POST['purchase_date']);
				$purchase_from = htmlspecialchars($_POST['purchase_from']);
				$manufacturer = htmlspecialchars($_POST['manufacturer']);
				$model = htmlspecialchars($_POST['model']);
				$status = htmlspecialchars($_POST['status']);
				$supplier = htmlspecialchars($_POST['supplier']);
				$condition = htmlspecialchars($_POST['condition']);
				$warrant = htmlspecialchars($_POST['warranty']);
				$price = htmlspecialchars($_POST['value']);
				$asset_user = htmlspecialchars($_POST['asset_user']);
				$description = htmlspecialchars($_POST['description']);
				$sql = "INSERT INTO `assets` ( `assetName`, `assetId`, `PurchaseDate`, `PurchaseFrom`, `Manufacturer`, `Model`, `Status`, `Supplier`, `AssetCondition`, `Warranty`, `Price`, `AssetUser`, `Description`)
				VALUES (:name, :id, :purchaseDate, :purchasefrom, :manufacturer, :model, :stats, :supplier, :condition, :warranty, :price, :user, :describe)";
				$query = $dbh->prepare($sql);
				$query->bindParam(':name', $asset, PDO::PARAM_STR);
				$query->bindParam(':id', $asset_id, PDO::PARAM_STR);
				$query->bindParam(':purchaseDate', $purchase_date, PDO::PARAM_STR);
				$query->bindParam(':purchasefrom', $purchase_from, PDO::PARAM_STR);
				$query->bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
				$query->bindParam(':model', $model, PDO::PARAM_STR);
				$query->bindParam(':stats', $status, PDO::PARAM_INT);
				$query->bindParam(':supplier', $supplier, PDO::PARAM_STR);
				$query->bindParam(':condition', $condition, PDO::PARAM_STR);
				$query->bindParam(':warranty', $warrant, PDO::PARAM_STR);
				$query->bindParam(':price', $price, PDO::PARAM_INT);
				$query->bindParam(':user', $asset_user, PDO::PARAM_STR);
				$query->bindParam(':describe', $description, PDO::PARAM_STR);
				$query->execute();
				$lastinserted = $dbh->lastInsertId();
				if ($lastinserted > 0) {
					echo "<script>alert('Asset Has Been Added');</script>";
					echo "<script>window.location.href='assets.php';</script>";
				} else {
					echo "<script>alert('Something Went Wrong Please Again.');</script>";
				}
			}
			//adding assets code ends here.
			$set = '1234567890';
			$id = substr(str_shuffle($set), 0, 6); ?>
			<div id="add_asset" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Asset</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Asset Name</label>
											<input name="asset_name" class="form-control" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Asset Id</label>
											<input readonly name="asset_id" value="<?php echo '#AST-' . $id; ?>" class="form-control" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Purchase Date</label>
											<input name="purchase_date" value="<?php echo date('dd/mm/yy'); ?>" class="form-control" type="date">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Purchase From</label>
											<input name="purchase_from" class="form-control" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Manufacturer</label>
											<input name="manufacturer" class="form-control" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Model</label>
											<input name="model" class="form-control" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Status</label>
											<select name="status" class="select">
												<option value="0">Pending</option>
												<option value="1">Approved</option>
												<option value="2">Deployed</option>
												<option value="3">Damaged</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Supplier</label>
											<input name="supplier" class="form-control" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Condition</label>
											<input name="condition" class="form-control" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Warranty</label>
											<input name="warranty" class="form-control" type="text" placeholder="In Months">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Value/Price</label>
											<input placeholder="1800" name="value" class="form-control" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Asset User</label>
											<select name="asset_user" class="select">
												<option>John Doe</option>
												<option>Richard Miles</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Description</label>
											<textarea name="description" class="form-control"></textarea>
										</div>
									</div>

								</div>
								<div class="submit-section">
									<button type="submit" name="add_asset" class="btn btn-primary submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Asset Modal -->
			<!-- Edit Asset Modal -->

			<?php
			// adding assets begins here
			if (isset($_GET['edit_asset'])) {
				$id = $_GET['editid'];
				if (isset($_POST['edit_asset'])) {
					if (empty($_POST['edit_asset'])) {
						echo "<script>alert('Asset hasnt been selected');</script>";
						exit;
					}
					$asset = htmlspecialchars($_POST['asset_name']);
					$asset_id = htmlspecialchars($_POST['asset_id']);
					$purchase_date = htmlspecialchars($_POST['purchase_date']);
					$purchase_from = htmlspecialchars($_POST['purchase_from']);
					$manufacturer = htmlspecialchars($_POST['manufacturer']);
					$model = htmlspecialchars($_POST['model']);
					$status = htmlspecialchars($_POST['status']);
					$supplier = htmlspecialchars($_POST['supplier']);
					$condition = htmlspecialchars($_POST['condition']);
					$warrant = htmlspecialchars($_POST['warranty']);
					$price = htmlspecialchars($_POST['value']);
					$asset_user = htmlspecialchars($_POST['asset_user']);
					$description = htmlspecialchars($_POST['description']);
					$sql = "UPDATE `assets` SET `assetName`=:name, `assetId`=:id, `PurchaseDate`=:purchaseDate, `PurchaseFrom`=:purchasefrom, `Manufacturer`=:manufacturer, `Model`=:model, `Status`=:stats, `Supplier`=:supplier, `AssetCondition`:condition, `Warranty`:warranty, `Price`:price, `AssetUser`:user, `Description`=:describe WHERE id=$id";
					$query = $dbh->prepare($sql);
					$query->bindParam(':name', $asset, PDO::PARAM_STR);
					$query->bindParam(':id', $asset_id, PDO::PARAM_STR);
					$query->bindParam(':purchaseDate', $purchase_date, PDO::PARAM_STR);
					$query->bindParam(':purchasefrom', $purchase_from, PDO::PARAM_STR);
					$query->bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
					$query->bindParam(':model', $model, PDO::PARAM_STR);
					$query->bindParam(':stats', $status, PDO::PARAM_INT);
					$query->bindParam(':supplier', $supplier, PDO::PARAM_STR);
					$query->bindParam(':condition', $condition, PDO::PARAM_STR);
					$query->bindParam(':warranty', $warrant, PDO::PARAM_STR);
					$query->bindParam(':price', $price, PDO::PARAM_INT);
					$query->bindParam(':user', $asset_user, PDO::PARAM_STR);
					$query->bindParam(':describe', $description, PDO::PARAM_STR);
					$coba = $query->execute();
					$lastinserted = $dbh->lastInsertId();
					$cari = "SELECT * FROM assets WHERE id = '$id'"; //selection for $nim only
					if ($lastinserted > 0) {
						echo "<script>alert('Asset Has Been Added');</script>";
						echo "<script>window.location.href='assets.php';</script>";
					} else {
						echo "<script>alert('Something Went Wrong Please Again.');</script>";
					}
					if ($id == 0) {
						$update = $dbh->query($cari);
						if ($update->rowCount() == 0) {
							echo "<script>alert('$id is unregistered');</script>";
							exit;
						} else {
							if ($coba) {
								echo
									"<script>alert('Data successfully updated');</script>";
							}
						}
					} else {
						echo "invalid data";
						exit;
					}
				}
				$querya = $dbh->query("SELECT * FROM assets WHERE id = '$id'");
				foreach ($querya as $data) {
			?>
					<div id="edit_asset" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Asset</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="POST" action="">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Asset Name</label>
													<input name="asset_name" class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Asset Id</label>
													<input readonly name="asset_id" value="<?php echo '#AST-' . $id; ?>" class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Purchase Date</label>
													<input name="purchase_date" value="<?php echo date('dd/mm/yy'); ?>" class="form-control" type="date">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Purchase From</label>
													<input name="purchase_from" class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Manufacturer</label>
													<input name="manufacturer" class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Model</label>
													<input name="model" class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Status</label>
													<select name="status" class="select">
														<option value="0">Pending</option>
														<option value="1">Approved</option>
														<option value="2">Deployed</option>
														<option value="3">Damaged</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Supplier</label>
													<input name="supplier" class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Condition</label>
													<input name="condition" class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Warranty</label>
													<input name="warranty" class="form-control" type="text" placeholder="In Months">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Value/Price</label>
													<input placeholder="1800" name="value" class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Asset User</label>
													<select name="asset_user" class="select">
														<option>John Doe</option>
														<option>Richard Miles</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
													<textarea name="description" class="form-control"></textarea>
												</div>
											</div>

										</div>
										<div class="submit-section">
											<button type="submit" name="edit_asset" class="btn btn-primary submit-btn">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<!-- Edit Asset Modal -->
			<!-- Delete Asset Modal -->
			<?php
			if (isset($_GET['delid'])) {
				$rid = intval($_GET['delid']);
				$sql = "DELETE from assets where id=:rid";
				$query = $dbh->prepare($sql);
				$query->bindParam(':rid', $rid, PDO::PARAM_STR);
				$query->execute();
				echo "<script>
				alert('Asset Has Been Deleted');
			</script>";
				echo "<script>
				window.location.href = 'assets.php'
			</script>";
			} ?>
			<div class="modal custom-modal fade" id="delete_asset" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Asset</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="assets.php?delid=<?php echo $row->id; ?>" type="submit" class="btn btn-primary continue-btn">Delete</a>
									</div>
									<div class="col-6">
										<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Asset Modal -->
		</div>
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->
	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap4.min.js"></script>
	<!-- Select2 JS -->
	<script src="assets/js/select2.min.js"></script>
	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

</body>

</html>