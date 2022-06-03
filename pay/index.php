<?php

include_once '../functions.php';


// Log all of the entries to the form
// DEBUG ONLY
// foreach ($_GET as $data) {
// 	consoleLog($data);
// }


// if the rank is set, get it from the form
if (isset($_GET['rank'])) {
	$rank_query = ucwords($_GET['rank']);
	$rank = $_GET['rank'];
}

if (isset($_GET['time'])) {
	$rank_query = ucwords($_GET['time']);
	$rank = $_GET['time'];
}



// Only if the series is set, use the series data in the query
if(isset($series_query)) {
	$query = 'SELECT * FROM "' . $branch_query . '" WHERE "rank" LIKE "%' . $rank_query . '%" AND "mos" LIKE "' . $series_query . '";';
	consoleLog("Query with series used");
	consoleLog("Query: " . $query);
} elseif(isset($rank_query)) {
	$query = 'SELECT * FROM "' . $branch_query . '" WHERE "rank" LIKE "%' . $rank_query . '%";';
	consoleLog("Query without series used");
	consoleLog("Query: " . $query);
}


$dir = 'sqlite:../db/pay_tables-db.db';
$dbh  = new PDO($dir) or die("Cannot open the database");

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
	include '/elements/favicon.php';
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
					<a class="nav-link" aria-current="page" href="/">Home</a>
					<a class="nav-link" aria-current="page" href="/bases/">Bases</a>
					<a class="nav-link active" aria-current="page" href="/pay/">Pay Scales</a>
					<?php
						include $_SERVER['DOCUMENT_ROOT'] . "/elements/branch_dropdown.php";
					?>
				</div>
			</div>
			<span class="navbar-text">
				Last Updated: 20220602
			</span>
		</div>
	</nav>


	<div class="container">
		<div class="col-1"></div>
		<div class="col-10">
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" class="form-horizontal">
				<section>
					<br>
					<small class="text-muted">Select your rank and greatest listed number of years of service:</small>
					<div class="input-group mb-3">
						<label class="input-group-text">Options</label>
						<select class="form-select" name="pay_rank" required>
							<option selected>Choose...</option>
							<?php
									$query_rank = 'SELECT pay_grade FROM "pay_scale_2022" ORDER BY "pay_grade" ASC;';
									foreach($dbh->query($query_rank) as $row) {
										echo '<option value="' . str_replace(' ','',$row['pay_grade']) . '" id="dontshowife1checker">' . $row['pay_grade'] . '</option>';
									}
								?>
						</select>
						<select class="form-select" name="pay_years" required>
							<option selected>Choose...</option>
							<?php
									foreach(['<4 Months','>4 Months', '3', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32', '36', '40'] as $row) {
										if ($row == '<4 Months') {
											echo '<option value="' . '<4Months' . '" class="dontshowife1">' . 'Less than 4 months of service' . '</option>';
										} else if ($row == '>4 Months') {
											echo '<option value="' . '>4Months' . '" class="dontshowife1">' . 'More than 4 months of service' . '</option>';
										} else {
												echo '<option value="' . $row . '" >' . $row . " or more years". '</option>';
										}
									}
								?>
						</select>
					</div>


				</section>
			</form>
			<div class="mx-auto">
				<a href="https://www.dfas.mil/Portals/98/Documents/militarymembers/militarymembers/pay-tables/2022%20Military%20Pay%20Tables.pdf"
					target="_blank">2022 Military Pay Tables.pdf</a>
				&middot;
				<a href="https://www.dfas.mil/Portals/98/Documents/militarymembers/militarymembers/pay-tables/2021%20Military%20Pay%20Tables.pdf"
					target="_blank">2021 Military Pay Tables.pdf</a>
			</div>

		</div>
		<div class="col-1"></div>
	</div>
	<script>
	checker = document.getElementById('dontshowife1checker');
	toremove = document.getElementById('dontshowife1');
	if (toremove.classList.contains('dontshowife1') && checker.selected) {
		checker.remove();
	}
	</script>
	<?php
		include $_SERVER['DOCUMENT_ROOT'] . "/elements/footer.php";
	?>
</body>

</html>