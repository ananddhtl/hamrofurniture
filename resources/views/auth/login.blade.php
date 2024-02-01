


@include('innerLayout.header')

<body>
	<div class="main-content">

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Hamro Furniture | Vendor Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="{{ route('vendor.login') }}" method="POST">
							@csrf
							<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
							<span class="text-danger">@error('email') {{ $message }} @enderror</span>

							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<span class="text-danger">@error('password') {{ $message }} @enderror</span>

							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<!-- <div class="forgot">
									<a href="#">forgot password?</a>
								</div> -->
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
							<div class="registration">
								Don't have an account ?
								<a class="" href="/register">
									Create an account
								</a>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>
	<!--footer-->
	<!-- <div class="footer">
		<p>&copy; 2022 Inventory System. All Rights Reserved | Developed by <a href="https://http://tukisoft.com.np/" target="_blank">Tuki Soft Pvt.Ltd.</a></p>
	</div> -->
	<!--//footer-->

</body>

</html>