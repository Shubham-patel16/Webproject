// Price Filter, Rating Filter, and Category Filter Functionality
document.addEventListener('DOMContentLoaded', function ()
{
    const priceFilters=document.querySelectorAll('.price-filter');
    const ratingFilters=document.querySelectorAll('.rating-filter');
    const productItems=document.querySelectorAll('.product-item');
    const productCount=document.getElementById('product-count');
    const sortSelect=document.querySelector('select[name="sort"]');

    // Only run if we're on the products page
    if (priceFilters.length===0||productItems.length===0) {
        return;
    }

    // Get selected category from URL or default to 'All'
    const urlParams=new URLSearchParams(window.location.search);
    const selectedCategory=urlParams.get('category')?
        urlParams.get('category').charAt(0).toUpperCase()+urlParams.get('category').slice(1):'All';

    // Function to filter products based on selected price ranges, ratings, and category
    function filterProducts()
    {
        // Get all checked price filters
        const checkedPriceFilters=Array.from(priceFilters).filter(checkbox => checkbox.checked);

        // Get all checked rating filters
        const checkedRatingFilters=Array.from(ratingFilters).filter(checkbox => checkbox.checked);

        // If no price filters are checked, hide all products
        if (checkedPriceFilters.length===0) {
            productItems.forEach(item =>
            {
                item.style.display='none';
            });
            if (productCount) {
                productCount.textContent='0';
            }
            return;
        }

        // Get price ranges from checked filters
        const priceRanges=checkedPriceFilters.map(checkbox => ({
            min: parseFloat(checkbox.getAttribute('data-min')),
            max: parseFloat(checkbox.getAttribute('data-max'))
        }));

        // Get selected ratings
        const selectedRatings=checkedRatingFilters.map(checkbox =>
            parseInt(checkbox.getAttribute('data-rating'))
        );

        let visibleCount=0;
        const visibleProducts=[];

        // Filter products
        productItems.forEach(item =>
        {
            const price=parseFloat(item.getAttribute('data-price'));
            const rating=parseInt(item.getAttribute('data-rating'));
            const category=item.getAttribute('data-category');

            let priceMatch=false;
            let ratingMatch=true;
            let categoryMatch=true;

            // Check if price falls within any of the selected ranges
            for (let range of priceRanges) {
                // Handle "Over $1000" case (max is 999999)
                if (range.max===999999) {
                    if (price>=range.min) {
                        priceMatch=true;
                        break;
                    }
                } else {
                    // For other ranges, check if price is within min (inclusive) and max (exclusive)
                    if (price>=range.min&&price<range.max) {
                        priceMatch=true;
                        break;
                    }
                }
            }

            // Check if rating matches any selected rating (if ratings are selected)
            if (selectedRatings.length>0) {
                ratingMatch=selectedRatings.includes(rating);
            }

            // Check if category matches (if category is not 'All')
            if (selectedCategory!=='All') {
                categoryMatch=category===selectedCategory;
            }

            // Show or hide the product
            if (priceMatch&&ratingMatch&&categoryMatch) {
                item.style.display='';
                visibleCount++;
                visibleProducts.push(item);
            } else {
                item.style.display='none';
            }
        });

        // Update product count
        if (productCount) {
            productCount.textContent=visibleCount;
        }

        // Sort visible products
        sortProducts(visibleProducts);
    }

    // Function to sort products
    function sortProducts(products)
    {
        if (!sortSelect) return;

        const sortValue=sortSelect.value;
        const container=document.getElementById('products-container');
        if (!container) return;

        // If sorting by featured, don't reorder
        if (sortValue==='featured') {
            return;
        }

        // Sort visible products
        const sortedProducts=[...products].sort((a, b) =>
        {
            switch (sortValue) {
                case 'price-low':
                    return parseFloat(a.getAttribute('data-price'))-parseFloat(b.getAttribute('data-price'));
                case 'price-high':
                    return parseFloat(b.getAttribute('data-price'))-parseFloat(a.getAttribute('data-price'));
                case 'rating':
                    return parseFloat(b.getAttribute('data-rating'))-parseFloat(a.getAttribute('data-rating'));
                default:
                    return 0;
            }
        });

        // Get all products (visible and hidden)
        const allProducts=Array.from(productItems);
        const hiddenProducts=allProducts.filter(p => p.style.display==='none');

        // Remove all products from container
        allProducts.forEach(product =>
        {
            product.remove();
        });

        // Add sorted visible products first
        sortedProducts.forEach(product =>
        {
            container.appendChild(product);
        });

        // Add hidden products at the end
        hiddenProducts.forEach(product =>
        {
            container.appendChild(product);
        });
    }

    // Add event listeners to all price filter checkboxes
    priceFilters.forEach(checkbox =>
    {
        checkbox.addEventListener('change', filterProducts);
    });

    // Add event listeners to all rating filter checkboxes
    ratingFilters.forEach(checkbox =>
    {
        checkbox.addEventListener('change', filterProducts);
    });

    // Add event listener to sort select
    if (sortSelect) {
        sortSelect.addEventListener('change', function ()
        {
            filterProducts();
        });
    }

    // Initial filter on page load
    filterProducts();
});

