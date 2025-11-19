<?php
// Determine base path based on current directory
$base_path = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>
<script src="<?php echo $base_path; ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base_path; ?>js/main.js"></script>
</body>

</html>