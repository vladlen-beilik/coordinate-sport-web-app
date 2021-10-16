<?php
display_messages();
$form_classes = 'card card-custom card-search';
if ($search_fields['search'] == '') { $form_classes .= " card-collapsed"; }
echo form_open($page_base . '#results', ['class' => $form_classes]); ?>
	<div class="card-header">
		<div class="card-title">
			<h3 class="card-label">Search</h3>
		</div>
		<div class="card-toolbar">
			<a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Toggle Card">
				<i class="ki ki-arrow-down icon-nm"></i>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class='row'>
			<div class='col-sm-2'>
				<p>
					<strong><label for="field_name">Name</label></strong>
				</p>
				<?php
				$data = array(
					'name' => 'search_name',
					'id' => 'field_name',
					'class' => 'form-control',
					'value' => $search_fields['name']
				);
				echo form_input($data);
				?>
			</div>
		</div>
	</div>
	<div class='card-footer'>
		<div class="d-flex justify-content-between">
			<button class='btn btn-primary btn-submit' type="submit">
				<i class='far fa-search'></i> Search
			</button>
			<a class='btn btn-default' href="<?php echo site_url($page_base); ?>">
				Cancel
			</a>
		</div>
	</div>
	<?php echo form_hidden('search', 'true'); ?>
<?php echo form_close(); ?>
<div id="results"></div>
<?php
if ($availability_cals->num_rows() == 0) {
	?>
	<div class="alert alert-info">
		No calendars found. Do you want to <?php echo anchor('settings/availabilitycals/new/', 'create one'); ?>?
	</div>
	<?php
} else {
	?>
	<?php echo $this->pagination_library->display($page_base); ?>
	<div class='card card-custom'>
		<div class='table-responsive'>
			<table class='table table-striped table-bordered'>
				<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Brand
						</th>
						<th>
							Activities
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($availability_cals->result() as $row) {
						?>
						<tr>
							<td class="name">
								<?php echo anchor('settings/availabilitycals/edit/' . $row->calID, $row->name); ?>
							</td>
							<td>
								<span class="label label-inline" style="<?php echo label_style($row->colour); ?>"><?php echo $row->brand; ?></span>
							</td>
							<td>
								<?php echo $row->activities; ?>
							</td>
							<td>
								<div class='text-right'>
									<a class='btn btn-info btn-sm' href='<?php echo site_url('bookings/availabilitycal/' . $row->calID); ?>' title="View">
										<i class='far fa-calendar-alt'></i>
									</a>
									<a class='btn btn-warning btn-sm' href='<?php echo site_url('settings/availabilitycals/edit/' . $row->calID); ?>' title="Edit">
										<i class='far fa-pencil'></i>
									</a>
									<a class='btn btn-danger btn-sm confirm-delete' href='<?php echo site_url('settings/availabilitycals/remove/' . $row->calID); ?>' title="Remove">
										<i class='far fa-trash'></i>
									</a>
								</div>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	echo $this->pagination_library->display($page_base);
}