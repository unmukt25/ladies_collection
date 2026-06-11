<?= $this->extend('main_layouts/frontend_index') ?>

<?= $this->section('content') ?>

<!-- ── MAIN CONTENT ─────────────────────────────────── -->
<main id="main-content">
    <div class="page-header">
        <div>
            <div class="page-title">Our <span>Collection</span></div>
            <div class="result-meta" id="resultMeta">Loading…</div>
        </div>
        <div class="sort-wrap">
            <label for="sortSel">Sort by</label>
            <select class="sort-select" id="sortSel" onchange="sortMode=this.value;render()">
                <option value="featured">Featured</option>
                <option value="newest">Newest</option>
                <option value="price-asc">Price: Low → High</option>
                <option value="price-desc">Price: High → Low</option>
                <option value="rating">Top Rated</option>
            </select>
        </div>
    </div>

    <div class="active-filters" id="chipBar"></div>
    <div class="cards-grid" id="cardsGrid"></div>
</main>

<script>
    let DRESSES = [];

    document.addEventListener("DOMContentLoaded", async function () {

        document.getElementById('resultMeta').innerText = "Loading dresses...";

        // ─── NEW: READ WISHLIST FROM COOKIE ON PAGE LOAD ───
        const savedWishlist = getWishlistCookie('user_wishlist'); // returns array e.g. [1, 4, 12]

        wishlist = new Set(savedWishlist); // Sync it back into the global wishlist Set        

        // Update navbar heart indicator dot based on recovered items
        document.getElementById('wishDot').style.display = wishlist.size ? 'block' : 'none';
        // ──────────────────────────────────────────────────

        /***************code to highlight the current page left nav****************/
        // get current page path
        const currentPath = window.location.pathname;

        // get all sidebar links
        const navLinks = document.querySelectorAll('.side-nav-link');

        navLinks.forEach(link => {

            // remove old active class
            link.classList.remove('active');

            // get href path only
            const linkPath = new URL(link.href).pathname;

            // compare current url with link url
            if (currentPath === linkPath) {

                link.classList.add('active');

            }

        });
        /*********************end logic to left nav********************/

        try {

            // get current url path
            const path = window.location.pathname;

            // split url into array
            const segments = path.split('/');

            // get last segment
            let category = segments[segments.length - 1];

            //if the url is http://localhost:8080/
            if (segments.length <= 2 || category === "") {
                category = "all-dresses";
            }

            // dynamic fetch url
            const response = await fetch(
                `<?= base_url('/data/dress-category/') ?>${category}`
            );

            const data = await response.json();

            // check http status
            if (!response.ok) {

                DRESSES = [];
                render();
                throw new Error(
                    `HTTP error! Status: ${response.status}`
                );

            }

            // check empty array
            if (!data || data.length === 0) {

                DRESSES = [];

                render();

                return;

            }

            DRESSES = data;

            render();

        } catch (error) {

            console.error(error);
            document.getElementById('resultMeta').innerText =
                "Failed to load dresses";
        }

        //updating active class based on current page 

    });

</script>
<?= $this->endSection() ?>