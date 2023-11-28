const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


window.addEventListener("DOMContentLoaded", event => {
  const callQueue = document.getElementById('callQueue');
  callQueue.addEventListener("click", () => {
    const audio = document.querySelector("audio");
    audio.volume = 0.2;
    audio.play();
  });
  
});


