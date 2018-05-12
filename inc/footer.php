<br/>
<br/>
<div class="footer">
	<div class="container">
		<div class="row">
				<div class="col-md-4">
					<h4>About</h4>
					<p>Oniline Child adoption System is a system that manages 
						the adoption process for The Department of Youth and Child Affairs in the Ministry of Gender, Labor, 
						and Social Development.</p>
						<br/>
				<br/>
				<br/>
					</div>
			<div class="col-md-4">
					<h4>Sitemap</h4>
					<ul>
						<li><a href="./"><i class="fas fa-angle-right"> </i> &nbsp; Home</a></li>
						<li><a href="./adopt.php"><i class="fas fa-angle-right"> </i> &nbsp; Adopt</a></li>
						<li><a href="./account.php"><i class="fas fa-angle-right"> </i> &nbsp; Login</a></li>
						<li><a href="./account.php"><i class="fas fa-angle-right"> </i> &nbsp; Register</a></li>
						<li><a href="./console.php"><i class="fas fa-angle-right"> </i> &nbsp; Admin Console</a></li>
					</ul>
			</div>
			<div class="col-md-4">
					<h4>Contact us</h4>
					<p>
						<i class="fas fa-phone"> </i>  &nbsp; +25675940447 &nbsp; | &nbsp; +31643458260
						<br/><br/>
						<i class="fas fa-envelope"> </i>  &nbsp; info@onlinechildadoption.com  &nbsp; |  &nbsp; onlinechildadoption@gmail.com
					</p>
					<br/><br/>
					<p>2018 &copy; all right reserved.</p>
			</div>
		</div>
	</div>
</div>


<div id="adoptModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h3 class="text-left">Please fill in this form</h3>
            </div>
            <div class="modal-body">
				
<form class="adoptForm" id="adoptForm">
                <p>This information is used by our System to determine whether your fit to adopt a child</p>
				<div class="input-group">
					<span class="input-group-addon">Marital Status</span>
					<select class="marital form-control">
						<option selected value="Single">Single</option>
						<option value="Married">Married</option>
						<option value="Divorced">Divorced</option>
					</select>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Proffession</span>
					<input name="Proffession" type="text" class="proffession form-control" placeholder="Proffession / Work" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Income</span>
					<input name="income" type="text" class="income form-control" placeholder="Monthly Income" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Languages you can speak</span>
					<textarea name="language" type="text" class="language form-control" placeholder="List them here" required></textarea>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Reason For Adopting the Child</span>
					<textarea name="reason" type="text" class="reason form-control" placeholder="Reason for Adopting the Child" required></textarea>
				</div>
				
			<br>
			<Button type="submit" class="continue btn btn-default">Adopt <span class="fa fa-angle-right"></span></Button>
</form>
                </div>
        </div>
    </div>
</div>


	<!-- Js files -->
	<script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/aos.js"></script>
	<script src="js/nprogress.js"></script>
	<!-- Magnific Popup core JS file -->
<script src="./js/jquery.magnific-popup.min.js"></script>
	<script src="./js/main.js"></script>
</body>

</html>