const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


$(document).ready(function() {
    // Memilih semua elemen dengan class .nav-link dan menambahkan event click
    $('.nav-link').click(function(e) {
      e.preventDefault(); // Menghentikan aksi default dari link
  
      // Memeriksa apakah elemen yang ditekan sudah memiliki class 'active'
      if ($(this).hasClass('active')) {
        // Jika sudah memiliki, maka hapus class 'active'
        $(this).removeClass('active');
      } else {
        // Jika belum memiliki, hapus class 'active' dari semua elemen dengan class .nav-link
        $('.nav-link').removeClass('active');
        
        // Tambahkan class 'active' ke elemen yang ditekan
        $(this).addClass('active');
      }
    });
  });
  