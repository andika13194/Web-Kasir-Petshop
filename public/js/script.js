let cart = [];
const modal = document.getElementById('addToCartModal');
const productNameElement = document.getElementById('product-name');
const productQuantityInput = document.getElementById('product-quantity');
let currentProduct = null;

document.querySelectorAll('.btn-add').forEach((button) => {
  button.addEventListener('click', function () {
    currentProduct = {
      id: this.getAttribute('data-id'),
      name: this.getAttribute('data-nama'),
      price: parseFloat(this.getAttribute('data-harga')),
    };

    productNameElement.innerText = `Nama Produk: ${currentProduct.name}`;
    modal.style.display = 'block'; // Tampilkan modal
  });
});

document.getElementById('confirm-add').addEventListener('click', function () {
  const quantity = parseInt(productQuantityInput.value);
  if (quantity > 0) {
    // Tambahkan produk ke keranjang atau update jumlah jika produk sudah ada
    const existingProduct = cart.find((item) => item.id === currentProduct.id);
    if (existingProduct) {
      existingProduct.quantity += quantity; // Update jumlah barang
    } else {
      cart.push({
        ...currentProduct,
        quantity: quantity,
      });
    }
    updateCart();
    modal.style.display = 'none'; // Sembunyikan modal
    productQuantityInput.value = ''; // Reset input
  } else {
    alert('Jumlah harus lebih dari 0');
  }
});

// Menutup modal ketika tombol close ditekan
document.querySelector('.close-btn').onclick = function () {
  modal.style.display = 'none';
};

// Menutup modal ketika klik di luar modal
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};

// Fungsi untuk memperbarui tampilan keranjang
function updateCart() {
  const cartTable = document.querySelector('.cart tbody');
  cartTable.innerHTML = ''; // Kosongkan tabel keranjang

  let total = 0;

  cart.forEach((item) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${item.name}</td>
      <td>
        <input type="number" value="${item.quantity}" min="1" class="quantity-input" data-id="${item.id}" />
      </td>
      <td>Rp ${numberWithCommas(item.price * item.quantity)}</td>
      <td><button class="btn-remove" data-id="${item.id}">Hapus</button></td>
    `;
    cartTable.appendChild(row);
    total += item.price * item.quantity;
  });

  // Update total di bagian pembayaran
  document.querySelector('.cart-total').innerText = `Total: Rp ${numberWithCommas(total)}`;
  document.getElementById('total-amount').innerText = `Rp ${numberWithCommas(total)}`;
}

// Format angka dengan koma
function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Event listener untuk tombol hapus
document.querySelector('.cart').addEventListener('click', function (e) {
  if (e.target.classList.contains('btn-remove')) {
    const productId = e.target.getAttribute('data-id');
    cart = cart.filter((item) => item.id !== productId);
    updateCart();
  }
});

// Event listener untuk perubahan jumlah barang
document.querySelector('.cart').addEventListener('input', function (e) {
  if (e.target.classList.contains('quantity-input')) {
    const productId = e.target.getAttribute('data-id');
    const newQuantity = parseInt(e.target.value);
    const product = cart.find((item) => item.id === productId);
    if (product && newQuantity > 0) {
      product.quantity = newQuantity;
      updateCart();
    }
  }
});

// Fungsi untuk menyelesaikan transaksi
// Fungsi untuk menyelesaikan transaksi
function finishTransaction() {
  const paymentMethod = document.getElementById('payment-method').value;
  const totalAmount = document.getElementById('total-amount').innerText.replace('Rp ', '').replace('.', '').trim();

  // Pastikan totalAmount adalah angka
  if (parseInt(totalAmount) > 0) {
    const items = cart.map((item) => ({
      id: item.id,
      quantity: item.quantity,
      price: item.price,
    }));

    // Kirim data ke server untuk menyimpan transaksi
    fetch('http://localhost/petArea/public/transaction/save', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        paymentMethod: paymentMethod,
        items: items,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert('Transaksi berhasil! ID Transaksi: ' + data.transactionId);

          // Kosongkan keranjang setelah transaksi berhasil
          cart = [];
          updateCart(); // Panggil fungsi untuk memperbarui tampilan keranjang

          // Reload halaman setelah transaksi berhasil
          setTimeout(function () {
            window.location.reload(); // Halaman akan di-refresh
          }, 1000); // Menunggu 1 detik agar pengguna dapat melihat pesan konfirmasi
        } else {
          alert('Transaksi gagal: ' + data.message);
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyelesaikan transaksi.');
      });
  } else {
    alert('Total pembayaran harus lebih dari 0.');
  }
}

// Event listener untuk tombol Selesaikan Transaksi
document.getElementById('finish-transaction').addEventListener('click', finishTransaction);
