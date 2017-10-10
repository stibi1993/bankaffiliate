<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php
if ($this->ion_auth->logged_in()) {
    ?>
    		<!-- jQuery -->
		<!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->
		<!-- script>
		alert("before");
		$("input, select").change(function(){
    		alert("changed");
		});    		
    	</script -->
<?php
}
?>
<footer>
    <p class="footer">
    </p>
</footer>

<?php echo $before_body; ?>


<!-- /#wrapper -->
</div>

<!-- /#page-wrapper -->
</div>

<!-- /#container-fluid -->
</div>



</body>

</html>