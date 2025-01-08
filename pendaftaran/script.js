let paketData = [];

// Fungsi untuk mengambil data paket dari API
async function fetchPaketData() {
    try {
        const response = await fetch('http://localhost:8081/html-trvl/paket-umroh/API/api.php');
        paketData = await response.json();
        populatePaketDropdown();
    } catch (error) {
        console.error('Error fetching paket data:', error);
        // Gunakan data dummy jika API gagal
        paketData = [
            { title: "Alfalah Reguler", price: "Rp. 25.000.000 / person" },
            { title: "Alfalah Ramadhan", price: "Rp. 20.000.000 / person" },
            { title: "Alfalah Gold", price: "Rp. 35.000.000 / person" },
            { title: "Alfalah Private", price: "Rp. 30.000.000 / person" },
            { title: "Alfalah Tour Plus", price: "Rp. 40.000.000 / person" }
        ];
        populatePaketDropdown();
    }
}

// Fungsi untuk mengisi dropdown paket
function populatePaketDropdown() {
    const select = document.getElementById('pilihPaket');
    select.innerHTML = '<option value="" selected disabled>Pilih salah satu paket</option>';

    paketData.forEach((paket, index) => {
        const option = document.createElement('option');
        option.value = index;
        option.textContent = `${paket.title} - ${paket.price}`;
        select.appendChild(option);
    });
}

// Fungsi untuk mengkonversi string harga ke number
function extractPrice(priceString) {
    return parseInt(priceString.replace(/[^0-9]/g, ''));
}

// Fungsi untuk memformat number ke format rupiah
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(number);
}

// Fungsi untuk menghitung total pembayaran
function calculateTotal() {
    const jumlahPendaftar = parseInt(document.getElementById('jumlahPendaftar').value) || 0;
    const selectedPaketIndex = document.getElementById('pilihPaket').value;

    if (selectedPaketIndex !== "" && jumlahPendaftar > 0) {
        const hargaPerOrang = extractPrice(paketData[selectedPaketIndex].price);
        const total = hargaPerOrang * jumlahPendaftar;
        document.getElementById('totalPembayaran').value = formatRupiah(total);
    } else {
        document.getElementById('totalPembayaran').value = '';
    }
}

// Event listeners
document.getElementById('jumlahPendaftar').addEventListener('input', calculateTotal);
document.getElementById('pilihPaket').addEventListener('change', calculateTotal);

document.getElementById('umrohForm').addEventListener('submit', function (e) {
    e.preventDefault();
    // Tambahkan logika submit form di sini
    alert('Form berhasil disubmit!');
});

// Inisialisasi
fetchPaketData();