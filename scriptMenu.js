document.getElementById('search-bar').addEventListener('input', function(e) {
var searchValue = e.target.value.toLowerCase();
var productElements = document.querySelectorAll('.smenu-product');

productElements.forEach(function(product) {
    var productName = product.querySelector('.name').textContent.toLowerCase();
    if (productName.includes(searchValue)) {
        product.style.display = '';
    } else {
        product.style.display = 'none';
    }
    });
});

// Para que mentir, esta parte fue un infierno, tenía un buen de errores, se rompía a cada rato y no funcionaba como debería, ChatGPT por suerte ayudó a debugearlo pero nah, un dolor total de cabeza, 0/10.
document.addEventListener('DOMContentLoaded', function() {
    const productSections = document.querySelectorAll('.smenu-product');
    const tcartBox = document.querySelector('.tcart-box');
    const purchaseButton = document.querySelector('.purchase-button');

    productSections.forEach(section => {
        section.addEventListener('click', function() {
            const id = section.getAttribute('data-id');
            const name = section.getAttribute('data-name');
            const price = parseFloat(section.getAttribute('data-price'));

            let cartItem = document.querySelector(`.cart-item[data-id="${id}"]`);
            if (cartItem) {
                let quantityInput = cartItem.querySelector('.item-quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateItemTotal(cartItem, price);
            } else {
                cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.setAttribute('data-id', id);
                cartItem.setAttribute('data-price', price);
                cartItem.innerHTML = `<div class="quantity-controls">
                                          <button class="decrement-quantity">-</button>
                                          <input type="number" class="item-quantity" value="1" min="1">
                                          <button class="increment-quantity">+</button>
                                      </div>
                                      <div class="item-details">
                                          <span class="item-name">${name}</span>
                                          <span class="item-price">Precio: $${price.toFixed(2)}</span>
                                      </div>
                                      <button class="remove-item" data-id="${id}">Remove</button>`;

                tcartBox.appendChild(cartItem);

                cartItem.querySelector('.increment-quantity').addEventListener('click', function() {
                    let quantityInput = cartItem.querySelector('.item-quantity');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    updateItemTotal(cartItem, price);
                    updateTotal();
                });

                cartItem.querySelector('.decrement-quantity').addEventListener('click', function() {
                    let quantityInput = cartItem.querySelector('.item-quantity');
                    if (quantityInput.value > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                        updateItemTotal(cartItem, price);
                        updateTotal();
                    }
                });

                cartItem.querySelector('.remove-item').addEventListener('click', function() {
                    cartItem.remove();
                    updateTotal();
                });

                cartItem.querySelector('.item-quantity').addEventListener('change', function() {
                    if (this.value < 1) this.value = 1;
                    updateItemTotal(cartItem, price);
                    updateTotal();
                });
            }
            updateItemTotal(cartItem, price);
            updateTotal();
        });
    });

    function updateItemTotal(cartItem, price) {
        const quantity = cartItem.querySelector('.item-quantity').value;
        const itemTotal = quantity * price;
        cartItem.querySelector('.item-price').innerText = 'Precio: $' + itemTotal.toFixed(2);
    }

    function updateTotal() {
        const cartItems = document.querySelectorAll('.cart-item');
        let total = 0;
        cartItems.forEach(item => {
            const quantity = item.querySelector('.item-quantity').value;
            const price = parseFloat(item.getAttribute('data-price'));
            total += quantity * price;
        });
        document.querySelector('.total-amount').innerText = 'Total: $' + total.toFixed(2);
    }

    purchaseButton.addEventListener('click', function() {
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length === 0) {
            alert('Your cart is empty!');
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let y = 10;
        doc.text('Purchase Receipt', 10, y);
        y += 10;

        cartItems.forEach(item => {
            const name = item.querySelector('.item-name').innerText;
            const quantity = item.querySelector('.item-quantity').value;
            const price = item.querySelector('.item-price').innerText;
            doc.text(`${name} - ${price} x ${quantity}`, 10, y);
            y += 10;
        });

        const total = document.querySelector('.total-amount').innerText;
        y += 10;
        doc.text(total, 10, y);

        doc.save('receipt.pdf');

        tcartBox.innerHTML = '';
        updateTotal();
    });
});
