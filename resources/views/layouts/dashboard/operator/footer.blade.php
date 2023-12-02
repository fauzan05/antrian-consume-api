<footer>
    <nav class="navbar fixed-bottom bg-body-tertiary">
        <div class="container-fluid">
            <span class="ms-3 text-body-secondary ">© 2023 Antrian Demo</span>
        </div>
    </nav>
</footer>
@push('js')
    @vite('resources/js/app.js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
@endpush
