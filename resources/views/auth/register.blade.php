

@include('innerLayout.header')

<body>
	<div class="main-content">

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Register</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="{{ route('vendor.register') }}" method="post">
							@csrf
							<input type="name" class="user" name="name" placeholder="Enter Your Name" required="">
							<span class="text-danger">@error('name') {{ $message }} @enderror</span>
							

							<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
							<span class="text-danger">@error('email') {{ $message }} @enderror</span>

							<input type="name" class="user" name="address" placeholder="Enter Your Address" required="">
							<span class="text-danger">@error('name') {{ $message }} @enderror</span>

							<input type="name" class="user" name="phone" placeholder="Enter Your Phone" required="">
							<span class="text-danger">@error('name') {{ $message }} @enderror</span>

							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<span class="text-danger">@error('Password') {{ $message }} @enderror</span>

							<input type="password" name="password_confirmation" class="lock" placeholder="Confirm Password" required="">
							<span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>


							<input type="submit" name="" value="Register">
							<div class="registration">

								<a class="" href="/login">
									Already login ?
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