<footer>
    <nav class="navbar mt-2 bg-body-tertiary">
        <div class="container-fluid">
            <span class="ms-3 text-body-secondary ">© 2023 Antrian Demo</span>
        </div>
    </nav>
</footer>
@push('js')
    <script src="{{ asset('js/clock.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
@endpush