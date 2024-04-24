// const request1 = [1, 2, 3, 4, 5, 6, 7, 8];
// const request2 = [1, 2, 3, 4, 5, 6, 7, 8];
// const queueAudio = [];
// queueAudio.push(request1);
// queueAudio.push(request2);
// // queueAudio.forEach(function(item, index) {
// //     console.log(print_r(item));
// // });
// queueAudio.shift();
// console.log(queueAudio[0]);

const audioFiles = [];
let isPlaying = false; // Menandai apakah audio sedang diputar atau tidak
document.addEventListener("DOMContentLoaded", function () {
  Echo.channel('current-queues-channel')
    .listen('CurrentQueuesEvent', (e) => {
      // Livewire.dispatch('currentQueueUpdated', e);
      const dataQueue = e['data'][3]; // data audio source
      dataQueue.push(e['data'][2]); // data counter id
      dataQueue.push(e['data'][1]); // data service_name
      dataQueue.push(e['data'][0]); // data number queue
      audioFiles.push(dataQueue);
      // console.log(e);
      // audioFiles.push(e['data'][2]);
      // console.log(audioFiles[0][audioFiles[0].length-1]);
      if (audioFiles.length > 0 && isPlaying == false) {
        // console.log("terpanggil");
        panggil(audioFiles);
      }
      // console.log(audioFiles[0][(audioFiles[0]).length-2]);
    });




function panggil(audioFiles) {
  isPlaying = true;
  var currentAudioIndex = 0;
  const number = audioFiles[0][(audioFiles[0]).length-1];
  const services = audioFiles[0][(audioFiles[0]).length-2];
  const counterId = audioFiles[0][(audioFiles[0]).length-3];

  Livewire.dispatch('currentQueueUpdated', { queueUpdated: [number, services] });
  // console.log(audioFiles);
  var audio = new Audio(audioFiles[0][currentAudioIndex]);
  if (currentAudioIndex < audioFiles[0].length) {
    audio.src = audioFiles[0][currentAudioIndex];
    audio.play();
    currentAudioIndex++;
    // Event 'ended' akan mendeteksi saat audio telah selesai diputar
    audio.addEventListener('ended', function () {
      // Memeriksa jika masih ada audio berikutnya dalam daftar
      if (currentAudioIndex < audioFiles[0].length-3) {
        audio.src = audioFiles[0][currentAudioIndex];
        audio.play();
        currentAudioIndex++;
      } else if (currentAudioIndex >= audioFiles[0].length-3 ){
        // mengenable button antrian sesuai dengan loket yang barusan memencetnya 
        Livewire.dispatch('buttonState', { counter_id: counterId });
        audioFiles.shift();
        isPlaying = false;
        // console.log(audioFiles.length); // mengetahui sisa audio antrian di dalam array
        // console.log(counterId);
        if (audioFiles.length > 0) {
          panggil(audioFiles);
        } else {
          audioFiles.shift();
          isPlaying = false;
        }
      }
    });
  }
}

});