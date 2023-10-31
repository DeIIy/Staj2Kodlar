const products = [
    { name: "Mavi_Firin", price: 10, rating: 4 , jpg: "Mavi_Firin.jpg"},
    { name: "Pembe_Bulasik_Makinesi", price: 15, rating: 5 , jpg: "Pembe_Bulasik_Makinesi.jpg"},
];

const cart = [];

const productContainer = document.getElementById("product-container");

products.forEach((product, index) => {
    const productBox = document.createElement("div");
    productBox.classList.add("product-box");
    productBox.innerHTML = `
        <img src="${product.jpg}" alt="${product.name}">
        <h3>${product.name}</h3>
        <p>Değerlendirme: ${product.rating}</p>
        <p>Fiyat: $${product.price}</p>
        <button class="add-to-cart" onclick="addToCart(${index})">Ekle</button>
    `;
    productContainer.appendChild(productBox);
});

const cartItemsContainer = document.getElementById("cart-items");

function updateCart() {
    cartItemsContainer.innerHTML = "";
    cart.forEach((item, index) => {
        const cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");
        cartItem.innerHTML = `
            <h3>${item.name}</h3>
            <p>Fiyat: $${item.price}</p>
            <p>Değerlendirme: ${item.rating}</p>
            <button class="remove-from-cart" onclick="removeFromCart(${index})">Sil</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });
}

function addToCart(productIndex) {
    cart.push(products[productIndex]);
    updateCart();
}

function removeFromCart(cartIndex) {
    cart.splice(cartIndex, 1);
    updateCart();
}

const buyButton = document.getElementById("buy-button");

buyButton.addEventListener("click", () => {
    alert("Satın alma işlemi tamamlandı.");
    cart.length = 0;
    updateCart();
});
