
	<div class="col-md-11 offset-1 mt-3">
		<table class="table table-striped table-bordered table-hover sell_cart">
			<thead>
				<th>S.L</th>
				<!-- <th>Added Date</th> -->
				<th>Company Name</th>
				<th>Product Name</th>
				<th>Product Code</th>
				
				<th>Batch</th>
				<th>Expire</th>
				<!-- <th>Total</th> -->
				<th>Current Stock</th>
				
				
			</thead>
			<tbody class="mytable_style" >
			
				<tr >
					<?php foreach ($stock_details as $key => $row) { ?>
						
					<td><?=$key+1;?></td>
					<!-- <td><?=date('d M Y', strtotime($row['created_at']));?></td> -->
					<td><?=$row['comp_name'];?></td>
					<td><?=$row['p_name'];?></td>
					<td><?=$row['p_code'];?></td>
					
					<td><?=$row['batch_id'];?></td>
					<td><?=date('d-m-Y', strtotime($row['expire_date']));?></td>
					<!-- <td><?=$row['total'];?></td> -->
					<td><?=$row['current_stock'];?></td>
					
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




