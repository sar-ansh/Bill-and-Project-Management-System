<div id="footer">Copyright <?php echo date("Y"); ?>, CPWD</div>
	</body>
</html>

<?php
	if(isset($connection)){
		mysqli_close($connection);
	}
?>