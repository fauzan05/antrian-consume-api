<footer style="padding-top: 30px">
    <nav class="navbar mt-2 bg-body-tertiary">
        <div class="container-fluid">
            <span class="ms-3 text-body-secondary ">© 2023 Antrian Demo</span>
        </div>
    </nav>
</footer>
@push('js')
    <script src="{{ asset('js/clock.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="{{ asset('js/call-queue.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
@endpush