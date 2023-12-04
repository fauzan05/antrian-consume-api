const audioFiles = [];
document.addEventListener("DOMContentLoaded", function () {
  Echo.channel('current-queues-channel')
    .listen('CurrentQueuesEvent', (e) => {
      Livewire.dispatch('currentQueueUpdated', e);
      e['data'][2].forEach(function (audio) {
        audioFiles.push(audio);
      });
      panggil(audioFiles);
      console.log(e['data'][2]);
    });
});
function panggil(audioFiles) {
  var currentAudioIndex = 0;
  var audio = new Audio(audioFiles[currentAudioIndex]);

  if (currentAudioIndex < audioFiles.length) {
    audio.src = audioFiles[currentAudioIndex];
    audio.play();
    currentAudioIndex++;
    // Event 'ended' akan mendeteksi saat audio telah selesai diputar
    audio.addEventListener('ended', function () {
      // Memeriksa jika masih ada audio berikutnya dalam daftar
      if (currentAudioIndex < audioFiles.length) {
        audio.src = audioFiles[currentAudioIndex];
        audio.play();
        currentAudioIndex++;
      } else {
        audioFiles.splice(null, audioFiles.length);
        Livewire.dispatch('buttonState');
      }
    });
  }
}
