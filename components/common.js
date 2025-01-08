// Fungsi untuk memuat komponen HTML
async function loadComponent(url, elementId) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const html = await response.text();
        document.getElementById(elementId).innerHTML = html;

        // Jika navbar, inisialisasi dropdown Bootstrap
        if (elementId === 'navbar-placeholder') {
            initializeDropdowns();
        }
    } catch (error) {
        console.error('Error loading component:', error);
    }
}

// Fungsi untuk menginisialisasi dropdown Bootstrap
function initializeDropdowns() {
    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
}