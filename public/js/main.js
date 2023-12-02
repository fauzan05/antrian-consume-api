document.addEventListener("DOMContentLoaded", function (event) {
  Echo.channel('current-queues-channel')
    .listen('CurrentQueuesEvent', (e) => {
      Livewire.dispatch('currentQueueUpdated', e);
      console.log(e);
    });
});