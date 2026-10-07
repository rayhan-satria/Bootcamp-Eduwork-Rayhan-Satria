    // 1. Data Dummy Produk
    let products = [
      { id: 1, 
        name: "Espresso", 
        category: "Hot Coffee", 
        price: 20000,
        description: "Pure cofee with zero distraction", 
        image: "images/Hot coffee/espresso.avif" 
    },
      { id: 2, 
        name: "Americano", 
        category: "Hot Coffee", 
        price: 25000,
        description: "Simple sleek coffee all day long", 
        image: "images/Hot coffee/americano.avif" 
    },
      { id: 3, 
        name: "Caffe Latte", 
        category: "Hot Coffee", 
        price: 30000,
        description: "Soft smooth and milky comfort", 
        image: "images/Hot coffee/caffe latte.avif" 
    },
      { id: 4, 
        name: "Cappucino", 
        category: "Hot Coffee", 
        price: 30000, 
        description: "Bold coffee with cloud foam",
        image: "images/Hot coffee/cappucino.avif" 
    },
      { id: 5, 
        name: "Mocha", 
        category: "Hot Coffee", 
        price: 35000,
        description: "Coffee meets sweet chocolate romance", 
        image: "images/Hot coffee/mocha.avif" 
    },
      { id: 6, 
        name: "Vietnam Drip", 
        category: "Cold Coffee", 
        price: 22000,
        description: "Slow drip, pure sweet patience", 
        image: "images/Cold coffee/vietnam drip.avif" 
    },
      { id: 7, 
        name: "Iced Coffee", 
        category: "Cold Coffee", 
        price: 25000, 
        description: "Classic chill for daily boost",
        image: "images/Cold coffee/iced coffee.avif" 
    },
      { id: 8, 
        name: "Cold Brew", 
        category: "Cold Coffee", 
        price: 28000, 
        description: "Steeped slow for smooth kick",
        image: "images/Cold coffee/cold brew.avif" 
    },
      { id: 9, 
        name: "Caramel Macchiato", 
        category: "Cold Coffee", 
        price: 35000, 
        description: "Layered espresso with golden drizzle",
        image: "images/Cold coffee/caramel macchiato.avif" 
    },
      { id: 10, 
        name: "Butterscotch", 
        category: "Cold Coffee", 
        price: 38000,
        description: "Rich coffee with buttery magic", 
        image: "images/Cold coffee/butterscotch.avif" 
    },
      { id: 11, 
        name: "Tea", 
        category: "Non Coffee", 
        price: 18000, 
        description: "Ice-cold tea always hits the spot",
        image: "images/Non coffee/es teh.avif" 
    },
      { id: 12, 
        name: "Chocolate", 
        category: "Non Coffee", 
        price: 28000, 
        description: "Rich dark chocolate served cold",
        image: "images/Non coffee/es coklat.avif" 
    },
      { id: 13, 
        name: "Taro", 
        category: "Non Coffee", 
        price: 30000,
        description: "Sweet purple taro on ice", 
        image: "images/Non coffee/es taro.avif" 
    },
      { id: 14, 
        name: "Red Velvet", 
        category: "Non Coffee", 
        price: 32000,
        description: "Creamy red velvet over ice", 
        image: "images/Non coffee/es red velvet.avif" 
    },
      { id: 15, 
        name: "Matcha", 
        category: "Non Coffee", 
        price: 35000,
        description: "Earthy green tea served ice-cold", 
        image: "images/Non coffee/es matcha.avif" 
    },
      { id: 16, 
        name: "Croissant", 
        category: "Pastries", 
        price: 22000,
        description: "Flaky golden butter pastry crisp", 
        image: "images/pastry/quasong-6ac25ab92da02.avif" 
    },
      { id: 17, 
        name: "Apple Pie", 
        category: "Pastries", 
        price: 28000,
        description: "Warm spiced apple pastry treat", 
        image: "images/pastry/apple-pie-6ac25ab89c438.avif" 
    },
      { id: 18, 
        name: "Cromboloni", 
        category: "Pastries", 
        price: 32000,
        description: "Crispy roll with creamy filling", 
        image: "images/pastry/kromboloni.webp" 
    },
      { id: 19, 
        name: "Strawberry Shortcake", 
        category: "Pastries", 
        price: 35000, 
        description: "Light sponge with fresh berries",
        image: "images/pastry/strawberry-shortcake-6ac25ab93a86a.avif" 
    },
      { id: 20, 
        name: "Tiramisu", 
        category: "Pastries", 
        price: 38000,
        description: "Rich coffee layered dessert slice", 
        image: "images/pastry/tiramisu-6ac25ab9ac40a.avif" 
    }
    ];

    let cart = [];
    let currentCategory = 'all';

    // Helper Format Rupiah
    function formatRupiah(number) {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }

    // 2. Function Render Produk ke HTML
    function displayProducts(items) {
      const productList = document.getElementById("product-list");
      productList.innerHTML = "";

      if (items.length === 0) {
        productList.innerHTML = `
          <div class="col-12 text-center py-5">
            <p class="fs-4 text-muted">Produk tidak ditemukan.</p>
          </div>
        `;
        return;
      }

      items.forEach(product => {
        const cardHTML = `
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card card-product h-100">
              <img src="${product.image}" class="card-img-top" alt="${product.name}">
              <div class="card-body d-flex flex-column">
                <span class="badge mb-2 align-self-start f-poppins" style="background-color: #a15e49">${product.category}</span>
                <h6 class="card-title fw-bold text-truncate f-play">${product.name}</h6>
                <p class="card-text m-0 f-outfit">${product.description}</p>
                <p class="card-text fw-semibold mb-3 f-outfit" style="color: #36453B">${formatRupiah(product.price)}</p>
                <button onclick="addToCart(${product.id})" class="btn btn-sm mt-auto">
                  <i class="bi bi-cart-plus f-play"></i> Tambah
                </button>
              </div>
            </div>
          </div>
        `;
        productList.innerHTML += cardHTML;
      });
    }

    // 3. Function Filter Produk Berdasarkan Kategori
    function filterProducts(category) {
      currentCategory = category;

      // Ubah style tombol aktif
      const buttons = document.querySelectorAll('.btn-filter');
      buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.textContent.trim().toLowerCase() === category.toLowerCase() || (category === 'all' && btn.textContent.trim() === 'Semua')) {
          btn.classList.add('active');
        }
      });

      // Reset pencarian & filter data
      document.getElementById('search-input').value = "";
      if (category === 'all') {
        displayProducts(products);
      } else {
        const filtered = products.filter(p => p.category === category);
        displayProducts(filtered);
      }
    }

    // 4. Function Live Search Produk
    function searchProducts() {
      const query = document.getElementById('search-input').value.toLowerCase();
      const filtered = products.filter(p => {
        const matchCategory = currentCategory === 'all' || p.category === currentCategory;
        const matchName = p.name.toLowerCase().includes(query);
        return matchCategory && matchName;
      });
      displayProducts(filtered);
    }

    // 5. Fitur Keranjang Belanja
    function addToCart(productId) {
      const product = products.find(p => p.id === productId);
      const existingItem = cart.find(item => item.id === productId);

      if (existingItem) {
        existingItem.qty += 1;
      } else {
        cart.push({ ...product, qty: 1 });
      }

      updateCartUI();
    }

    function updateCartUI() {
      // Update badge count
      const totalCount = cart.reduce((sum, item) => sum + item.qty, 0);
      document.getElementById('cart-badge').textContent = totalCount;

      // Update list di Modal
      const cartItemsContainer = document.getElementById('cart-items');
      cartItemsContainer.innerHTML = "";

      if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<li class="list-group-item text-center text-muted py-4">Keranjang Anda masih kosong</li>';
        document.getElementById('cart-total').textContent = formatRupiah(0);
        return;
      }

      let grandTotal = 0;
      cart.forEach(item => {
        const itemTotal = item.price * item.qty;
        grandTotal += itemTotal;

        cartItemsContainer.innerHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-0">${item.name}</h6>
              <small class="text-muted">${formatRupiah(item.price)} x ${item.qty}</small>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="fw-bold">${formatRupiah(itemTotal)}</span>
              <button onclick="removeFromCart(${item.id})" class="btn btn-sm btn-outline-danger">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </li>
        `;
      });

      document.getElementById('cart-total').textContent = formatRupiah(grandTotal);
    }

    function removeFromCart(productId) {
      cart = cart.filter(item => item.id !== productId);
      updateCartUI();
    }

    function checkout() {
      if (cart.length === 0) {
        alert("Still staring? Order already, dont be shy!");
        return;
      }
      alert("Sit back, chief. we're on it!");
      cart = [];
      updateCartUI();
      
      // Tutup modal bootstrap secara otomatis
      const modalElement = document.getElementById('cartModal');
      const modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    }

    // Inisialisasi Tampilan Awal
    document.addEventListener("DOMContentLoaded", () => {
      displayProducts(products);
    });