import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    // --- Fungsi Helper ---
    function updateCartCount(count) {
        const desktopCountEl = document.getElementById("cart-count-desktop");
        const mobileCountEl = document.getElementById("cart-count-mobile");
        const elements = [desktopCountEl, mobileCountEl];

        elements.forEach((el) => {
            if (el) {
                el.textContent = count;
                if (count > 0) {
                    el.classList.remove("hidden");
                } else {
                    el.classList.add("hidden");
                }
            }
        });
    }

    let notificationTimeout;
    function showNotification(message) {
        const banner = document.getElementById("notification-banner");
        if (banner) {
            banner.textContent = message;
            banner.classList.remove("hidden");

            // Clear any existing timer
            clearTimeout(notificationTimeout);

            // Hide after 3 seconds
            notificationTimeout = setTimeout(() => {
                banner.classList.add("hidden");
            }, 3000);
        }
    }

    // --- Logika Halaman Menu ---
    const menuPage = document.querySelector(".category-btn");
    if (menuPage) {
        const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");
        addToCartButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const productId = this.dataset.productId;
                const productName = this.dataset.productName;
                const quantityInput = document.getElementById(
                    "quantity-" + productId
                );
                const quantity = parseInt(quantityInput.value, 10);

                if (quantity > 0) {
                    axios
                        .post("/cart/add", {
                            product_id: productId,
                            quantity: quantity,
                        })
                        .then((response) => {
                            if (response.data.success) {
                                updateCartCount(response.data.cart_count);
                                showNotification(
                                    `Anda telah memesan ${productName} dengan jumlah ${quantity}`
                                );
                            }
                        })
                        .catch((error) => {
                            console.error("Error adding to cart:", error);
                            alert("Gagal menambahkan item.");
                        });
                }
            });
        });

        // Category Filtering Logic
        const categoryButtons = document.querySelectorAll(".category-btn");
        const productCards = document.querySelectorAll(".product-card");
        const categoryGroups = document.querySelectorAll(".category-group");

        categoryButtons.forEach((button) => {
            button.addEventListener("click", function () {
                // Update active button style
                categoryButtons.forEach((btn) =>
                    btn.classList.remove("active", "bg-red-600", "text-white")
                );
                this.classList.add("active", "bg-red-600", "text-white");

                const selectedCategory = this.dataset.category;

                if (selectedCategory === "all") {
                    // Show all products and groups
                    productCards.forEach(
                        (card) => (card.style.display = "flex")
                    );
                    categoryGroups.forEach(
                        (group) => (group.style.display = "block")
                    );
                } else {
                    // Hide all groups first
                    categoryGroups.forEach(
                        (group) => (group.style.display = "none")
                    );
                    // Show only the selected group
                    const groupToShow = document.getElementById(
                        "category-" + selectedCategory
                    );
                    if (groupToShow) {
                        groupToShow.style.display = "block";
                    }
                }
            });
        });
    }

    // --- Logika Halaman Keranjang ---
    // --- Logika Halaman Keranjang ---
    const cartContainer = document.getElementById("cart-items-wrapper");

    if (cartContainer) {
        cartContainer.addEventListener("click", function (e) {
            const target = e.target;

            function handleUpdate(promise, productId) {
                promise
                    .then((response) => {
                        if (response.data.success) {
                            // Update cart count in navbar
                            updateCartCount(response.data.cart_count);

                            // Jika keranjang kosong
                            if (response.data.cart_count === 0) {
                                document.getElementById(
                                    "cart-container"
                                ).innerHTML =
                                    '<p class="text-center text-gray-500">Keranjang Anda kosong.</p>';
                                return;
                            }

                            // Update total
                            const cartTotalEl =
                                document.getElementById("cart-total");
                            if (cartTotalEl) {
                                cartTotalEl.innerText =
                                    "Rp " +
                                    new Intl.NumberFormat("id-ID").format(
                                        response.data.cart_total
                                    );
                            }

                            // Update row sesuai produk
                            const newQuantity =
                                response.data.cart_items?.[productId]?.quantity;

                            // Cari semua row (desktop & mobile) dengan id yang sama
                            const rows = document.querySelectorAll(
                                "#row-" + productId
                            );

                            rows.forEach((row) => {
                                if (!newQuantity) {
                                    // Jika quantity 0 → hapus row
                                    row.remove();
                                } else {
                                    // Update quantity & subtotal
                                    const quantitySpan =
                                        row.querySelector(".quantity-span");
                                    const subtotalEl =
                                        row.querySelector(".subtotal");
                                    const price =
                                        response.data.cart_items[productId]
                                            .price;

                                    if (quantitySpan) {
                                        quantitySpan.textContent = newQuantity;
                                    }
                                    if (subtotalEl) {
                                        subtotalEl.textContent =
                                            "Rp " +
                                            new Intl.NumberFormat(
                                                "id-ID"
                                            ).format(newQuantity * price);
                                    }
                                }
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Error updating cart:", error);
                        alert("Gagal memperbarui keranjang.");
                    });
            }

            // Tombol Hapus
            if (target.classList.contains("remove-item-btn")) {
                const productId = target.dataset.productId;
                handleUpdate(
                    axios.post("/cart/remove", { product_id: productId }),
                    productId
                );
            }

            // Tombol Update Kuantitas (+ / -)
            if (target.classList.contains("quantity-btn")) {
                const productId = target.dataset.productId;
                const change = parseInt(target.dataset.change, 10);

                // Ambil quantitySpan terdekat (biar bisa jalan di mobile & desktop)
                const quantitySpan = target
                    .closest("#row-" + productId)
                    .querySelector(".quantity-span");
                const currentQuantity = parseInt(quantitySpan.textContent, 10);
                const newQuantity = currentQuantity + change;

                if (newQuantity > 0) {
                    handleUpdate(
                        axios.post("/cart/update", {
                            product_id: productId,
                            quantity: newQuantity,
                        }),
                        productId
                    );
                } else {
                    handleUpdate(
                        axios.post("/cart/remove", { product_id: productId }),
                        productId
                    );
                }
            }
        });
    }

    // --- Mobile Sidebar Logic ---
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileSidebar = document.getElementById("mobile-sidebar");
    const sidebarContent = document.getElementById("sidebar-content");

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener("click", function () {
            mobileSidebar.classList.remove("hidden");
            setTimeout(() => {
                sidebarContent.classList.remove("-translate-x-full");
            }, 10);
        });

        mobileSidebar.addEventListener("click", function (e) {
            // Close sidebar if clicking on the overlay
            if (e.target === mobileSidebar) {
                sidebarContent.classList.add("-translate-x-full");
                setTimeout(() => {
                    mobileSidebar.classList.add("hidden");
                }, 300);
            }
        });
    }
});
