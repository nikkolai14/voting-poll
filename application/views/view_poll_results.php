<!DOCTYPE html>
<html>
<head>
	<title>PHP Poll Voting System</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/w3layouts.css'); ?>">
</head>
<body>
	<div class="w3-container">
	  	<div class="w3-row">
	  		<div class="w3-row">
			  <div class="w3-col l12">
			    <p><a href="<?php echo site_url('home/index'); ?>">Back</a></p>
			  </div>
			  <div class="w3-col l12 w3-center">
			    <h1>Poll Voting Results</h1>
			  </div>

			  <div class="w3-col l12 w3-center">
			  	<p>Total Votes: <?php echo $poll_results[1]['total_votes']['total_votes'];?></p>
			  </div>

		  		<?php 
				  	$choice_list = $poll_results[2];
				  	$choice_list_legnth = count($poll_results[2]);
				  	$i = 0;

			  		foreach($choice_list as $choice):
			  			$vote_percentage = round(($poll_results[0][$i][$choice_list[$i]]['vote_option'] / $poll_results[1]["total_votes"]["total_votes"]) * 100);
			 	?>
			 
				  <div class="w3-col l12">
				  	<p class="w3-center"><?php echo $choice_list[$i]; ?></p>
				  	<div class="w3-light-grey" style="margin-bottom: 10px;">
					  <div class="w3-container w3-green w3-center" style="width:<?php echo $vote_percentage; ?>%"><?php echo $vote_percentage; ?>%</div>
					</div>
				  </div>

				<?php 
					$i++;
					endforeach; 
				?>
			</div>
		</div>
	</div>
</body>
</html>