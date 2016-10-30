<?php require_once BASEPATH."../assets/front/lib/header.php" ?> 
	<img src="<?php echo $hostdetail['image']; ?>" height="200" width="200"><br>
	You are Invited by Mr/Ms/Mrs. <?php echo $hostdetail['FirstName'].' '.$hostdetail['LastName']; ?>, and you can contact with this person on <?php echo $hostdetail['userEmail']; ?>. If you know this person and want to join this party so click on accept. If you are not so please on cancel
	<button onclick="acceptParty('<?php echo $token; ?>');">Accept</button>
	<button onclick="cancelParty();">Cancel</button>
<?php require_once BASEPATH."../assets/front/lib/footer.php" ?> 
