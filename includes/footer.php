<div class="row">
<p></p>
</div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="wow shake" data-wow-delay="0.4s">
					<div class="page-scroll marginbot-30">
						<a href="#top" id="totop" class="btn btn-circle">
							<i class="fa fa-angle-double-up animated"></i>
						</a>
					</div>
					</div>
					<?php if (isset($_SESSION['email'])){
						echo '<p><a href="change_password.php">Change Password</a> | <a href="#">Edit Account Info</a></p>';
					}?>
					
					
					<p>&copy;Copyright 2015 - BCR. All rights reserved.</p>
					
					<p>Special thanks to: <br><a href="http://bootstraptaste.com/squadfree-free-bootstrap-template-creative/">Squadfree</a> | <a href="http://getbootstrap.com">Bootstrap</a> | <a href="https://www.datatables.net/">DataTables</a> | <a href="http://leaverou.github.io/awesomplete/">Awesomplete</a> | <a href="http://openexchangerates.github.io/accounting.js/">Accounting.js </a>
				</div>
			</div>	
		</div>
	</footer>
	

</body>

</html>
