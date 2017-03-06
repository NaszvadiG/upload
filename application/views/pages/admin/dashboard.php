<body class="hold-transition skin-red sidebar-mini">
	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Assalamu'alaikum
					<small><?php echo $this->session->userdata('name_admin') ?></small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url() ?>administrator"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- Info boxes -->
				<div class="row">
					<div class="col-md-4">
						<div class="info-box bg-aqua">
							<span class="info-box-icon"><i class="ion ion-ios-people"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Members</span>
								<span class="info-box-number"><?php echo $m_sum ?> Registered</span>

								<div class="progress">
									<div class="progress-bar" style="width: 100%"></div>
								</div>
								<span class="progress-description">
									<?php echo $city_sum ?> Different cities
								</span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</div>
					<!-- /.col -->

					<div class="col-md-4">
						<div class="info-box bg-green">
							<span class="info-box-icon"><i class="ion ion-briefcase"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Orders</span>
								<span class="info-box-number"><?php echo $or_compl ?> Completed</span>

								<div class="progress">
									<div class="progress-bar" style="width: <?php echo $or_perc ?>%"></div>
								</div>
								<span class="progress-description">
									<?php echo $or_sum ?> Total orders (<?php echo $or_perc ?> %)
								</span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</div>
					<!-- /.col -->

					<div class="col-md-4">
						<div class="info-box bg-red">
							<span class="info-box-icon"><i class="ion ion-key"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">APIs</span>
								<span class="info-box-number"><?php echo $api_act ?> Activated</span>

								<div class="progress">
									<div class="progress-bar" style="width: <?php echo $api_perc ?>%"></div>
								</div>
								<span class="progress-description">
									<?php echo $api_sum ?> Total APIs (<?php echo $api_perc ?> %)
								</span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</div>
					<!-- /.col -->

				</div>
				<!-- /.row -->

				<!-- Main row -->
				<div class="row">
					<!-- Left col -->
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<!-- USERS LIST -->
								<div class="box box-danger">
									<div class="box-header with-border">
										<h3 class="box-title">Latest Login Members</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body no-padding">
										<ul class="users-list clearfix">
											<?php $i=0; foreach ($lat_mem as $value): ?>
												<?php $str = $lat_mem[$i]['first_name']; ?>
												<li>
													<img src="<?php echo site_url().'public/assets/img/'.ucfirst($str[0]).'.png' ?>" alt="User Image">
													<a class="users-list-name" href="#"><?php echo $str ?></a>
													<span class="users-list-date"><?php echo $lat_mem[$i]['last_login'] ?></span>
												</li>
											<?php $i++; endforeach ?>
										</ul>
										<!-- /.users-list -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer text-center">
										<a href="<?php echo site_url() ?>administrator/members" class="uppercase">View All Members</a>
									</div>
									<!-- /.box-footer -->
								</div>
								<!--/.box -->
							</div>
							<!-- /.col -->
							<div class="col-md-8">
								<!-- TABLE: LATEST ORDERS -->
								<div class="box box-info">
									<div class="box-header with-border">
										<h3 class="box-title">Latest Generated APIs</h3>

										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<div class="table-responsive">
											<table class="table no-margin">
												<thead>
													<tr>
														<th>Domain</th>
														<th>API Key</th>
														<th>Last Updated On</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php  
														for ($i=0; $i < sizeof($api_show); $i++) {
															echo "<tr>"; 
															for ($j=0; $j < sizeof($api_show[$i]); $j++) {
																if ($j == sizeof($api_show[$i])-1) {
																 	if ($api_show[$i][$col_name[$j]] == 1) 
																 		echo '<td><span class="label label-info">Ready</span></td>';
																 	elseif($api_show[$i][$col_name[$j]] == 2)
																 		echo '<td><span class="label label-danger">Expired</span></td>';
																 	else 
																 		echo '<td><span class="label label-success">Activated</span></td>';
																 }else 
																	echo '<td>'.$api_show[$i][$col_name[$j]].'</td>';
															}
															echo "</tr>";
														}
													?>
												</tbody>
											</table>
										</div>
										<!-- /.table-responsive -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer text-center">
										<a href="<?php echo site_url() ?>administrator/api" class="uppercase">View All API</a>
									</div>
									<!-- /.box-footer -->
								</div>
								<!-- /.box -->
							</div>
						</div>
						<!-- /.row -->

					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
