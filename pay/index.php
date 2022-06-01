<?php

include_once '../functions.php';

?>
<html lang="en">

<head>
	<title>Military Job Consideration Tool</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="/style.css">
	<script src="/showSeries.js"></script>
	<?php
	include "favicon.php";
	?>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<div class="container-fluid">
			<div class="navbar-brand">Military Job Search</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navab"
				aria-controls="navab" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navab">
				<div class="navbar-nav">
					<a class="nav-link active" aria-current="page" href="/">Home</a>
					<a class="nav-link" aria-current="page" href="/bases/">Bases</a>
					<a class="nav-link" aria-current="page" href="/pay/">Pay Scales</a>
					<div class="dropdown">
						<a class="btn btn-light dropdown-toggle" href="#" role="button" id="branchDropdown"
							data-bs-toggle="dropdown" aria-expanded="false">
							Branch Websites
						</a>
						<ul class="dropdown-menu" aria-labelledby="branchDropdown">
							<li>
								<a class="dropdown-item" target="_blank" href="https://goarmy.com">Army</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.airforce.com/">Air
									Force</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.marines.com/">Marine
									Corps</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.navy.com/">Navy</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.gocoastguard.com/">Coast
									Guard</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<span class="navbar-text">
				Last Updated: 20220601
			</span>
		</div>
	</nav>
	<div class="container">
		<div class="col-1"></div>
		<div class="col-10">
			<div class="row">
				<h3>Pay Scales for 2022</h3>
				<a href="https://www.dfas.mil/Portals/98/Documents/militarymembers/militarymembers/pay-tables/2022%20Military%20Pay%20Tables.pdf"
					target="_blank">2022 Military Pay Tables.pdf</a>
				<h3>Pay Scales for 2021</h3>
				<a href="https://www.dfas.mil/Portals/98/Documents/militarymembers/militarymembers/pay-tables/2021%20Military%20Pay%20Tables.pdf"
					target="_blank">2021 Military Pay Tables.pdf</a>
			</div>
		</div>
		<div class="col-1"></div>
	</div>
	<?php
		include '/footer.php';
	?>
</body>

</html>