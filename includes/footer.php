<?php
// Determine base path based on current directory
$base_path = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>
<footer class="bg-dark text-white py-2">
    <div class="pt-2 text-center">
        <p class="mb-0">&copy; 2026 Premium Collection. All rights reserved.</p>
    </div>
</footer>
<script src="<?php echo $base_path; ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base_path; ?>js/main.js"></script>
</body>

</html>