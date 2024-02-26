@extends('index')
@section('content')
<div id="page-wrapper">
	<div class="main-page">
		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-arrow-down icon-rounded"></i>
					<div class="stats">
						<h5><strong>{{$stockInOrOut[0]->inqty}}</strong></h5>
						<span>Total Stock In</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-arrow-up user1 icon-rounded"></i>
					<div class="stats">
						<h5><strong>{{$stockInOrOut[0]->outqty}}</strong></h5>
						<span>Total Stock Out</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa-thin fa-chart-line-down"></i>
					<i class="pull-left fa fa-trash user2 icon-rounded"></i>
					<div class="stats">
						<h5><strong>{{$damage[0]->outqty}}</strong></h5>
						<span>Total Damage</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-list dollar1 icon-rounded"></i>
					<div class="stats">
						<h5><strong>{{$items}}</strong></h5>
						<span>Total Items</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-users dollar2 icon-rounded"></i>
					<div class="stats">
						<h5><strong>{{$users}}</strong></h5>
						<span>Total Users</span>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

		<div class="row-one widgettable">

			<div class="col-md-12">
				<div class="inline-form widget-shadow">
					<div class="form-title">
						<h4>Recent Status </h4>
					</div>
				</div>

				<div class="panel-body widget-shadow">
					<!-- <h4>Basic Table:</h4> -->
					<table class="table">
						<thead>
							<tr>
								<th>SN.</th>
								<th>Item Name</th>
								<th>Stock In</th>
								<th>Stock Out</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>


							<?php $i = 0; ?>
							@foreach ($reports as $item)
							<?php $i++; ?>

							@if($item->itemName)

							<tr>
								<th scope="row">{{ $i }}</th>
								<td>{{ $item->itemName }}</td>
								<td>{{ $item->inqty }}</td>
								<td>{{ $item->ouqty }}</td>
								<td>{{ $item->totalQty }}</td>

							</tr>
							@endif
							@endforeach

						</tbody>

						{{-- @endif   --}}
					</table>

				</div>
			</div>
			
			<div class="clearfix"> </div>
		</div>




		<!-- for amcharts js -->
		



	</div>
</div>
@endsection