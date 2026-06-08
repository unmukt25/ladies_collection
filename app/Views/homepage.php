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
    let DRESSES= [];
    // let DRESSES = [
    //     {
    //         id: 1,
    //         name: "Aurora Floral Midi",
    //         cat: "Casual",
    //         style: ['Floral', 'Printed'],
    //         price: 2499,
    //         old: 3299,
    //         rating: 4.7,
    //         rev: 238,
    //         badge: "New",
    //         colors: ["#e8c4b8", "#8ab89a", "#fff"],
    //         sizes: ["XS", "S", "M", "L"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 2,
    //         name: "Velvet Noir Evening Gown",
    //         cat: "Evening",
    //         style: ['Solid'],
    //         price: 8999,
    //         old: null,
    //         rating: 4.9,
    //         rev: 87,
    //         badge: "",
    //         colors: ["#2e2622", "#6a8caf"],
    //         sizes: ["S", "M", "L", "XL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 3,
    //         name: "Ivory Lace Bridal Gown",
    //         cat: "Bridal",
    //         style: ['Embroidered'],
    //         price: 14500,
    //         old: null,
    //         rating: 5.0,
    //         rev: 42,
    //         badge: "",
    //         colors: ["#fff", "#e8c4b8"],
    //         sizes: ["XS", "S", "M", "L", "XL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 4,
    //         name: "Rose Petal Wrap Dress",
    //         cat: "Casual",
    //         style: ['Solid'],
    //         price: 1899,
    //         old: 2499,
    //         rating: 4.4,
    //         rev: 312,
    //         badge: "Sale",
    //         colors: ["#c9716a", "#e8c4b8"],
    //         sizes: ["XS", "S", "M"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 5,
    //         name: "Cobalt Sequin Mini",
    //         cat: "Party",
    //         style: ['Floral', 'Printed'],
    //         price: 4299,
    //         old: 5499,
    //         rating: 4.6,
    //         rev: 154,
    //         badge: "Sale",
    //         colors: ["#6a8caf", "#2e2622"],
    //         sizes: ["S", "M", "L"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 6,
    //         name: "Sage Linen Sundress",
    //         cat: "Casual",
    //         style: ['Solid'],
    //         price: 1599,
    //         old: null,
    //         rating: 4.3,
    //         rev: 426,
    //         badge: "New",
    //         colors: ["#8ab89a", "#c8a96e"],
    //         sizes: ["XS", "S", "M", "L", "XL", "XXL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 7,
    //         name: "Champagne Off-Shoulder",
    //         cat: "Evening",
    //         style: ['Printed'],
    //         price: 6799,
    //         old: 8200,
    //         rating: 4.8,
    //         rev: 99,
    //         badge: "",
    //         colors: ["#c8a96e", "#fff"],
    //         sizes: ["S", "M", "L"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 8,
    //         name: "Oxford Pencil Dress",
    //         cat: "Office",
    //         style: ['Floral', 'Printed'],
    //         price: 3199,
    //         old: null,
    //         rating: 4.5,
    //         rev: 203,
    //         badge: "",
    //         colors: ["#2e2622", "#7a5c52", "#6a8caf"],
    //         sizes: ["XS", "S", "M", "L", "XL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 9,
    //         name: "Fuchsia Ruffle Maxi",
    //         cat: "Party",
    //         style: ['Solid'],
    //         price: 3799,
    //         old: null,
    //         rating: 4.2,
    //         rev: 67,
    //         badge: "New",
    //         colors: ["#c9716a", "#e8c4b8", "#fff"],
    //         sizes: ["S", "M", "L", "XL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 10,
    //         name: "Pearl Embroidered Kurta",
    //         cat: "Casual",
    //         style: ['Solid'],
    //         price: 2799,
    //         old: 3400,
    //         rating: 4.6,
    //         rev: 511,
    //         badge: "Sale",
    //         colors: ["#fff", "#c8a96e", "#e8c4b8"],
    //         sizes: ["XS", "S", "M", "L", "XL", "XXL"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 11,
    //         name: "Midnight Halter Gown",
    //         cat: "Evening",
    //         style: ['Solid'],
    //         price: 11200,
    //         old: 13500,
    //         rating: 4.9,
    //         rev: 58,
    //         badge: "",
    //         colors: ["#2e2622"],
    //         sizes: ["S", "M", "L"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    //     {
    //         id: 12,
    //         name: "Blush Satin A-Line",
    //         cat: "Bridal",
    //         style: ['Solid'],
    //         price: 12800,
    //         old: null,
    //         rating: 4.8,
    //         rev: 34,
    //         badge: "New",
    //         colors: ["#e8c4b8", "#fff"],
    //         sizes: ["XS", "S", "M", "L"],
    //         img: "https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75",
    //     },
    // ];

    document.addEventListener("DOMContentLoaded", async function () {

        document.getElementById('resultMeta').innerText = "Loading dresses...";

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
               category = "all-dresses" ;
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