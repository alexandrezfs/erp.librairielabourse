<div class="span3 text-align-center">

	<div class="row-fluid well">

		<p class="very-small-text">
			<a href="#" onclick="openSmallNetwork(); return false;">[Version fenêtre]</a>
		</p>

		<input type="text" id="message-network" class="full-width" placeholder="Nouveau message">
		<input type="hidden" id="username-network" value="<?php echo $_SESSION['username'] ?>">

		<div id="network-messages">

		</div>

	</div>

	<div class="row-fluid well small-text">

		<input type="text" id="new-tache" class="full-width" placeholder="Nouvelle tâche">

		<div id="taches-table">

		</div>

		<div id="alert-tache">

		</div>

	</div>

</div>