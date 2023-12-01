<footer>
    <nav class="navbar mt-2 bg-body-tertiary">
        <div class="container-fluid">
            <span class="ms-3 text-body-secondary ">© 2023 Antrian Demo</span>
        </div>
    </nav>
</footer>
@vite('resources/js/app.js')
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        Echo.channel('current-queues-channel')
            .listen('CurrentQueuesEvent', (e) => {
                Livewire.dispatch('currentQueueUpdated', e);
                console.log(e);
            });
    });
</script>
@stack('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>