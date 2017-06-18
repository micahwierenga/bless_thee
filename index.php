<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bless Thee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style type="text/css">
    	body {
    		background-color: rgba(143, 143, 121, 1);
    		background-color: #333;
    		color: #000;
    		color: #fff;
    	}
    	h3 {
    		text-align: center;
    		font-size: 60px;
    		margin-bottom: 30px;
    	}
    	table {
    		text-align: center;
    		vertical-align: middle;
    	}
    	.scoreboard {
    		text-align: center;
    		font-size: 36px;
    	}
    	.player {
    		font-size: 60px;
    		padding: 200px;
    	}
    	.btn {
    		margin-right: 10px;
    	}
    	.emotional_status {
    		width: 50px;
    		height: 50px;
    	}
    	.copyright {
    		text-align: center;
    		font-size: 14px;
    		position: absolute;
    		bottom: 0;
    		left: 50%;
    	}
    </style>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="anonymous"></script>
	  
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
		$(".emotion1").html('<img src="images/smiling.png" class="emotional_status">');
		$(".emotion2").html('<img src="images/neutral.png" class="emotional_status">');
		$(".emotion3").html('<img src="images/expressionless.png" class="emotional_status">');
		$(".emotion4").html('<img src="images/sad.png" class="emotional_status">');
	});

	function blessed(id, name) {
		window.location.reload();
		jQuery.ajax({
			type: "POST",
			data: {id: id, name: name},
			url: "blessed.php",
			cache: false,
			success: function(response) {
				alert(name + " has disseminated a blessing");
			}
		});
	}

	function cursed(id, name) {
		window.location.reload();
		jQuery.ajax({
			type: "POST",
			data: {id: id, name: name},
			url: "cursed.php",
			cache: false,
			success: function(response) {
				alert(name + " has brought shame upon his or her head");
			}
		});
	}
	</script>
</head>
 
<body>
	<div class="container">

		<div class="row">
			<h3>Bless Thee</h3>
		</div>

		<div class="row">
			<!-- <p>
			<a href="create.php" class="btn btn-success">Create</a>
			</p> -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="scoreboard">Rank</th>
						<th class="scoreboard">Player</th>
						<th class="scoreboard">Score</th>
						<th class="scoreboard">Emotional Status</th>
						<th class="scoreboard">Blessings and Cursings</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = 'SELECT 
								id,
								FIND_IN_SET( score, (
								SELECT GROUP_CONCAT( score
								ORDER BY score DESC )
								FROM player )
								) AS rank,
								name,
								score,
								emotional_status
							FROM player
							ORDER BY rank;';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
							echo '<td class="player">' . $row['rank'] . '</td>';
							echo '<td class="player">' . $row['name'] . '</td>';
							echo '<td class="player">' . $row['score'] . '</td>';
							echo '<td class="emotion' . $row['rank'] . '"></td>';
							echo '<td>
									<input type="button" class="btn btn-success" value="Bless" onClick="blessed(\'' . $row['id'] . '\',\'' . $row['name'] . '\');">
									<input type="button" class="btn btn-warning" value="Curse" onClick="cursed(\'' . $row['id'] . '\',\'' . $row['name'] . '\');">
									</td>';
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
		</div>
	</div> <!-- /container -->
	<footer>
		<div class="copyright">&copy; booj CRM</div>
	</footer>
</body>

</html>