@include('innerLayout.header')

<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a href="" target="_blank" style="text-align: center;"> <img style="padding: 5px;" width="70%" class="responsive" src="logo.png"/></a>	

						<p style="color: white; padding:5px; font-size:13px; margin-bottom:10px;">Welcome  <span style="font-size: 12px;">{{Auth::user()->name}}</span> </p>
					


					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MAIN ENTRY</li>
							<li class="treeview">
								<a href="/">
									<span>Dashboard</span>
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<span>Master </span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{ url('/stockin') }}"><i class="fa fa-angle-right"></i> Stock In</a></li>
									<li><a href="{{ url('/stockOut') }}"><i class="fa fa-angle-right"></i> Stock Out</a></li>
									<li><a href="{{ url('/damage') }}"><i class="fa fa-angle-right"></i> Stock Damage</a></li>
									<li><a href="{{ url('/adjust') }}"><i class="fa fa-angle-right"></i>Stock Adjustment</a></li>
								</ul>
							</li>


							<!-- <li class="treeview">
								<a href="#">

									<span>Items</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="#"><i class="fa fa-angle-right"></i> Create</a></li>
									<li><a href="#"><i class="fa fa-angle-right"></i> Alter</a></li>
									<li><a href="#"><i class="fa fa-angle-right"></i> Delete</a></li>

								</ul>
							</li> -->
							<li class="treeview">
								<a href="#">

									<span>Item Setting</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{ url('/item') }}"><i class="fa fa-angle-right"></i> Items</a></li>
									<li><a href="{{ url('/group') }}"><i class="fa fa-angle-right"></i> Item Group</a></li>
									<li><a href="{{ url('/subgroup') }}"><i class="fa fa-angle-right"></i> Item Subgroup</a></li>
									<li><a href="{{ url('/Company') }}"><i class="fa fa-angle-right"></i> Item Brand / Company</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">

									<span>Misc.</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{ url('/companyInfo')}}"><i class="fa fa-angle-right"></i>Company Info</a></li>
								
								</ul>
							</li>
							<li class="header">REPORTS</li>


							<li class="treeview">
								<a href="#">
									<span>Stock</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{ url('/Todaytotalstock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Today </span></a></li>
									<li><a href="{{ url('/reports')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Status</span></a></li>
									<li><a href="{{ url('/instock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>In</span></a></li>
									<li><a href="{{ url('/outstock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Out</span></a></li>
									<li><a href="{{ url('/itemwisestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Item-wise</span></a></li>
									<li><a href="{{ url('/Groupwisestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Group-wise</span></a></li>
									<li><a href="{{ url('/SubGroupwisestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Sub Group-wise </span></a></li>
									<li><a href="{{ url('/Companywisestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Company-wise </span></a></li>

								</ul>
							</li>

							<li class="treeview">
								<a href="#">
									<span>Damage</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{ url('/damagestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Date Between</span></a></li>
									<li><a href="{{ url('/itemwisedamagestock')}}"><i class="fa fa-angle-right text-aqua"></i> <span>Item-wise</span></a></li>
								</ul>
							</li>


							<li class="header">ACCOUNT</li>

							<li><a href="{{ url('/signout')}}"><i class="fa fa-angle-right"></i> Log Out</a></li>



						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button style="margin-left: 20px;" id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left">

					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //header-ends -->
		<!-- main content start-->



		@yield('content')





		<!--footer-->
		<!-- <div class="footer">
			<p>&copy; 2022 Inventory System. All Rights Reserved | Developed by <a href="https://tukisoft.com.np/" target="_blank">Tuki Soft Pvt.Ltd.</a></p>
		</div> -->
		<!--//footer-->
	</div>

	@include('innerLayout.footer')

</body>

</html>