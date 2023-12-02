function showTime() {
    var date = new Date(),
      options = {
        timeZone: 'Asia/Jakarta',
        hour12: false, // Menampilkan format 24 jam
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
      },
      jakartaTime = new Intl.DateTimeFormat('en-US', options).format(date);
  
    document.getElementById('time').innerHTML = jakartaTime;
  }
  setInterval(showTime, 1000);