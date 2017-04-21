<!DOCTYPE html>
<html>
<head>
	<title>PHP Poll Voting System</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/w3layouts.css'); ?>">
</head>
<body>
  	<div class="w3-row">
	  <div class="w3-rest w3-container w3-center">
	    <h1>PHP Poll Voting System in CodeIgniter</h1>
	  </div>

	  <div class="w3-rest w3-container w3-center">
	  	<?php if ($save_msg): ?>
	  		<p>Vote saved!</p>
		<?php endif; ?>

		<?php echo form_open('home/submit_vote'); ?>
	  		<?php $poll_answers = json_decode($poll->answer_list); ?>
		  	<p><?php echo $poll->question; ?></p>

		  	<?php foreach($poll_answers as $poll_choice): ?>

		  	<input class="w3-radio" type="radio" name="poll_choice" value="<?php echo $poll_choice; ?>">
			<label><?php echo $poll_choice; ?></label><br><br>

			<?php endforeach; ?>

			 <p><button class="w3-button w3-indigo" type="submit">Vote</button></p>
		</form>

		<a href="<?php echo site_url('home/view_poll_results'); ?>">View Poll Results</a>
	  </div>
	</div>
</body>
</html>