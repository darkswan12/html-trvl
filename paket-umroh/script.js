// URL API PHP
const apiURL = 'http://localhost:8081/html-trvl/paket-umroh/API/api.php'; // Pastikan URL benar

// Fungsi untuk mengambil data dari API
async function fetchData() {
  try {
    const response = await fetch(apiURL);

    // Periksa apakah respons berhasil
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    console.log('Data fetched:', data); // Debugging: pastikan data benar
    generateCards(data);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

// Fungsi untuk membuat card berdasarkan data dari API
function generateCards(data) {
  if (!Array.isArray(data)) {
    console.error('Data is not an array:', data);
    return;
  }

  const container = document.getElementById('card-container');
  container.innerHTML = ''; // Kosongkan container sebelum menambahkan card baru
  data.forEach(item => {
    const card = `
      <div class="col">
        <div class="card position-relative">
          <img src="${item.image}" class="card-img-top" alt="${item.title}">
          <span class="badge bg-success">${item.badge}</span>
          <div class="card-body">
            <h5 class="card-title">${item.title}</h5>
            <p class="card-text">${item.price}</p>
            <a href="../detail/detail.php" class="btn btn-primary">View Detail</a>
          </div>
        </div>
      </div>
    `;
    container.innerHTML += card;
  });
}

// Panggil fetchData saat halaman dimuat
fetchData();
