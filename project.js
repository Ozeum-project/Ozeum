document.addEventListener("DOMContentLoaded", function () {
  // Zoom functionality
  const container = document.querySelector(".zoom-container");
  const img = container.querySelector(".product-image");
  const lens = container.querySelector(".zoom-lens");

  const zoomLevel = 2.5;

  container.addEventListener("mousemove", function (e) {
    const rect = container.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const xPercent = (x / rect.width) * 100;
    const yPercent = (y / rect.height) * 100;

    lens.style.backgroundImage = `url(${img.src})`;
    lens.style.backgroundSize = `${zoomLevel * 100}%`;
    lens.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
  });

  container.addEventListener("mouseenter", function () {
    lens.style.opacity = 1;
  });

  container.addEventListener("mouseleave", function () {
    lens.style.opacity = 0;
  });

  // Cart functionality
  const buyNowBtn = document.querySelector(".buy-now-btn");
  const viewCartBtn = document.querySelector(".view-cart-btn");
  const cartOverlay = document.querySelector(".cart-overlay");
  const closeCartBtn = document.querySelector(".close-cart");
  const overlayBg = document.querySelector(".overlay-background");
  const quantityInput = document.querySelector(".quantity");
  const cartItems = document.querySelector(".cart-items");
  const totalAmount = document.querySelector(".total-amount");

  function openCart() {
    cartOverlay.classList.add("active");
    overlayBg.classList.add("active");
    updateCart();
  }

  function closeCart() {
    cartOverlay.classList.remove("active");
    overlayBg.classList.remove("active");
  }

  function updateCart() {
    const quantity = parseInt(quantityInput.value);
    const price = 12.0; // Sale price
    const total = quantity * price;

    cartItems.innerHTML = `
                    <div class="cart-item">
                        <img src="/api/placeholder/80/80" alt="Woman Eating">
                        <div class="cart-item-details">
                            <h3>Woman Eating</h3>
                            <p class="cart-item-price">$${price.toFixed(
                              2
                            )} × ${quantity}</p>
                        </div>
                        <span class="cart-item-total">$${(
                          price * quantity
                        ).toFixed(2)}</span>
                    </div>
                `;

    totalAmount.textContent = `$${total.toFixed(2)}`;
  }

  buyNowBtn.addEventListener("click", openCart);
  viewCartBtn.addEventListener("click", openCart);
  closeCartBtn.addEventListener("click", closeCart);
  overlayBg.addEventListener("click", closeCart);

  // Update cart when quantity changes
  quantityInput.addEventListener("change", updateCart);
});

function montrer() {
  document.querySelector(".notification").style.visibility = "visible";
}

function cacher() {
  document.getElementById("notification").style.display = "none";
} 

function increment(){ 
 var i= document.getElementsByClassName("arrowUp").value; 
  i++ ;  
  console.log(i);
  

}