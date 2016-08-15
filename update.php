<?php session_start(); include("header.php"); ?>

<div class="panel-heading">Latest Decks Randomizer</div>
<div class="panel-body">
	<p>If you didn't feel like choosing cards from the latest deck release yourself, you can use the randomizer below to choose for you! This randomizer chooses 1 card from each of the decks released; however, if you want to take two from a deck, feel free to change one of them out. Just make sure your card worth stays the same!</p>

	<br />

	<p>
		<center>
			<?php
				$result = $mysqli->query("SELECT * FROM `cards` WHERE worth='1' OR worth='2' AND released = 'Yes' ORDER BY `id` DESC LIMIT 5") or die("Unable to select from database.");
					$min = 1;
					$max = mysqli_num_rows($result);

				for($i=0; $i<5; $i++) {
					mysqli_data_seek($result,rand($min,$max)-1);
					$row = $result->fetch_object();
                	$digits = rand(01,$row->count);

                	if (strstr($rewards, $row->filename)){
						while (strstr($rewards, $row->filename)) {
							mysqli_data_seek($result,rand($min,$max)-1);
							$row = $result->fetch_object();
							$digits = rand(01,$row->count);
						}
					}

					elseif ($digits < 10) { 
						$_digits = "0$digits"; 
					} 

					else { 
						$_digits = $digits;
					}

					$card = "$row->filename$_digits";
					echo "<img class='set' src='cards/$filename$card.png' border='0' /> ";
					$rewards .= $card.", ";
				}

				$rewards = substr_replace($rewards,"",-2);
				echo "<br /><b>New Decks</b>: $rewards";
			?>
		</center>
	</p>

	<br />

	<div class="backbox">&laquo; <a href="index.php">Back to updates?</a></div>
</div>



<?php include("footer.php"); ?>