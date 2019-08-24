

<?php 

$dates = $model->confDates;
if($dates){
	echo '<table class="table table-hovered">
		<thead>
		<tr>
			<th>Date Items</th>
			<th>Dates</th>
		</tr>
		</thead>
	';
	foreach($dates as $date){
		echo '<tr>';
			echo '<td>' . $date->date_name . '</td>';
			echo '<td> <i class="fa fa-calendar"></i> ' . date('d F Y', strtotime($date->date_start)) . '</td>';
			
		echo '</tr>';
	}
	echo '</table>';
}

?>
