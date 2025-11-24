<footer style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem 0;">
    <div class="pt-2 text-center">
        <p class="mb-0">&copy; 2026 Premium Collection. All rights reserved.</p>
    </div>
</footer>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
<script>
    // Update cart badge on all pages
    document.addEventListener('DOMContentLoaded', function () {
        function updateCartBadge() {
            const cart=JSON.parse(localStorage.getItem('cart'))||[];
            const totalItems=cart.reduce((sum, item) => sum+item.quantity, 0);
            const badge=document.querySelector('.cart-badge');
            if (badge)
            {
                badge.textContent=totalItems;
            }
        }
        updateCartBadge();
    });
</script>
</body>

</html>