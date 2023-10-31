const products = [
    { name: "Beyaz Buzdolabı", category: "Buzdolabı", price: 1500, rating: 4, image: "Beyaz_Buzdolabi.jpg" },
    { name: "Beyaz Fırın", category: "Fırın", price: 2200, rating: 3, image: "Beyaz_Firin.jpg" },
    { name: "Beyaz Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 2800, rating: 5, image: "Beyaz_Bulasik_Makinesi.jpg" },
    { name: "Beyaz Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 1900, rating: 4, image: "Beyaz_Camasir_Makinesi.jpg" },
    { name: "Beyaz Ocak", category: "Ocak", price: 1100, rating: 4, image: "Beyaz_Ocak.jpg" },
    { name: "Siyah Buzdolabı", category: "Buzdolabı", price: 1700, rating: 3, image: "Siyah_Buzdolabi.jpg" },
    { name: "Siyah Fırın", category: "Fırın", price: 2500, rating: 4, image: "Siyah_Firin.jpg" },
    { name: "Siyah Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 3200, rating: 5, image: "Siyah_Bulasik_Makinesi.jpg" },
    { name: "Siyah Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 2100, rating: 3, image: "Siyah_Camasir_Makinesi.jpg" },
    { name: "Siyah Ocak", category: "Ocak", price: 1200, rating: 4, image: "Siyah_Ocak.jpg" },
    { name: "Pembe Buzdolabı", category: "Buzdolabı", price: 1600, rating: 5, image: "Pembe_Buzdolabi.jpg" },
    { name: "Pembe Fırın", category: "Fırın", price: 2300, rating: 3, image: "Pembe_Firin.jpg" },
    { name: "Pembe Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 2700, rating: 4, image: "Pembe_Bulasik_Makinesi.jpg" },
    { name: "Pembe Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 2000, rating: 4, image: "Pembe_Camasir_Makinesi.jpg" },
    { name: "Pembe Ocak", category: "Ocak", price: 1300, rating: 5, image: "Pembe_Ocak.jpg" },
    { name: "Gri Buzdolabı", category: "Buzdolabı", price: 1800, rating: 3, image: "Gri_Buzdolabi.jpg" },
    { name: "Gri Fırın", category: "Fırın", price: 2400, rating: 4, image: "Gri_Firin.jpg" },
    { name: "Gri Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 3100, rating: 3, image: "Gri_Bulasik_Makinesi.jpg" },
    { name: "Gri Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 2200, rating: 4, image: "Gri_Camasir_Makinesi.jpg" },
    { name: "Gri Ocak", category: "Ocak", price: 1400, rating: 5, image: "Gri_Ocak.jpg" },
    { name: "Sarı Buzdolabı", category: "Buzdolabı", price: 1900, rating: 4, image: "Sari_Buzdolabi.jpg"},
    { name: "Sarı Fırın", category: "Fırın", price: 2600, rating: 3, image: "Sari_Firin.jpg" },
    { name: "Sarı Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 3300, rating: 5, image: "Sari_Bulasik_Makinesi.jpg" },
    { name: "Sarı Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 2300, rating: 4, image: "Sari_Camasir_Makinesi.jpg" },
    { name: "Sarı Ocak", category: "Ocak", price: 1500, rating: 4, image: "Sari_Ocak.jpg" },
    { name: "Mavi Buzdolabı", category: "Buzdolabı", price: 2000, rating: 3, image: "Mavi_Buzdolabi.jpg" },
    { name: "Mavi Fırın", category: "Fırın", price: 2700, rating: 4, image: "Mavi_Firin.jpg" },
    { name: "Mavi Bulaşık Makinesi", category: "Bulaşık Makinesi", price: 3400, rating: 5, image: "Mavi_Bulasik_Makinesi.jpg" },
    { name: "Mavi Çamaşır Makinesi", category: "Çamaşır Makinesi", price: 2400, rating: 3, image: "Mavi_Camasir_Makinesi.jpg" },
    { name: "Mavi Ocak", category: "Ocak", price: 1600, rating: 4, image: "Mavi_Ocak.jpg" },
];

const productList = document.querySelector(".product-list");
const categoryFilter = document.getElementById("categoryFilter");
const priceFilters = document.querySelectorAll('input[type="checkbox"][id^="price"]');
const ratingFilters = document.querySelectorAll('input[type="checkbox"][id^="rating"]');
const applyFiltersButton = document.getElementById("applyFilters");
const resetFiltersButton = document.getElementById("resetFilters");

function filterAndRenderProducts() {
    const selectedCategory = categoryFilter.value;
    const selectedPrices = Array.from(priceFilters).filter(filter => filter.checked).map(filter => filter.value);
    const selectedRatings = Array.from(ratingFilters).filter(filter => filter.checked).map(filter => parseInt(filter.value));

    const filteredProducts = products.filter(product => {
        return (!selectedCategory || product.category === selectedCategory) &&
            (selectedPrices.length === 0 || selectedPrices.includes(getPriceRange(product.price))) &&
            (selectedRatings.length === 0 || selectedRatings.includes(product.rating));
    });

    renderProducts(filteredProducts);
}

function renderProducts(productsToRender) {
    productList.innerHTML = "";

    productsToRender.forEach(product => {
        const productDiv = document.createElement("div");
        productDiv.classList.add("product");

        const productImage = document.createElement("img");
        productImage.src = product.image; 
        productDiv.appendChild(productImage);

        const productName = document.createElement("h3");
        productName.textContent = product.name;
        productDiv.appendChild(productName);

        const productPrice = document.createElement("p");
        productPrice.textContent = "Fiyat: " + product.price + " TL";
        productDiv.appendChild(productPrice);

        const productRating = document.createElement("p");
        productRating.textContent = "Değerlendirme: " + product.rating + " yıldız";
        productDiv.appendChild(productRating);

        productList.appendChild(productDiv);
    });
}

function getPriceRange(price) {
    if (price >= 1000 && price < 2000) return "1000-2000";
    if (price >= 2000 && price < 3000) return "2000-3000";
    if (price >= 3000 && price < 4000) return "3000-4000";
    if (price >= 4000 && price < 5000) return "4000-5000";
    return "";
}

resetFiltersButton.addEventListener("click", () => {
    categoryFilter.value = "";
    priceFilters.forEach(filter => (filter.checked = false));
    ratingFilters.forEach(filter => (filter.checked = false));
    filterAndRenderProducts();
});

applyFiltersButton.addEventListener("click", () => {
    filterAndRenderProducts();
});

filterAndRenderProducts();

