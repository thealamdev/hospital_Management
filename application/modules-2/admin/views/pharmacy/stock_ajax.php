
	<div class="col-md-12 mt-3">
		<table class="table table-striped table-bordered table-hover test_table_report">
			<thead>
				<tr>
				<th>S.L</th>
				<th>Date</th>
				<th>Product Name</th>
				<th>Product Code</th>
				<!-- <th>Batch</th> -->
				<th>Expire</th>
				<!-- <th>Total</th> -->
				<th>Opening Stock</th>
				<th>Stock In</th>
				<!-- <th>Purchase Return</th> -->
				<th>Stock Out</th>
				
				<th>Closing Stock</th>
			</tr>
				<!-- <th>Remain</th> -->
			</thead>
			<tbody class="mytable_style" >
			
				<tr>
					<?php foreach ($stock_details as $key => $row) { ?>
						
					<td><?=$key+1;?></td>
					<td><?=date('d M Y', strtotime($row['st_date']));?></td>
					<td><?=$row['p_name'];?></td>
					<td><?=$row['p_code'];?></td>
					
					<td><?=date("d-m-Y", strtotime($row['expire_date']))?></td>
					<!-- <td><?=$row['total'];?></td> -->
					<td><?=$row['stock_open'];?></td>
					<td><?=$row['stock_in'];?></td>
					<td><?=$row['stock_out'];?></td>

			<!-- 		<?php if($row['stock_type']==3){?>

						<td><?=$row['stock_out'];?></td>
						<td>0</td>

					<?php } else { ?>

						<td>0</td>
						<td><?=$row['stock_out'];?></td>

					<?php } ?> -->
					
					
					<td><?=$row['stock_close'];?></td>
					<!-- <td><?=$row['remain'];?></td> -->
				</tr>
				<?php } ?>
				
				
		</tbody>										
	</table>
	</div>
								
	<style type="text/css">
		.mytable_style tr td{
			padding: 3px !important;
			color:#000 !important;
			text-align: center;
			vertical-align: middle !important;
		}
		.mytable_style tr td input{
			color:#000 !important;
		}
		.sell_cart thead th{
		text-align: center !important;
		background: #EFF3F8;
		color: #0f0808;
		font-weight: 600;
		}
		.sell_cart_input{
			padding: 5px 0px !important;
		    margin: 0 auto !important;
		    height: auto !important;
		    width: 100% !important;
		    text-align: center !important;
		}
		.icon_tag_input{
			width: 100% !important;
			float: right;
		}
		.input-group-addon {
			padding: 6px 6px !important;
		}
	</style>




