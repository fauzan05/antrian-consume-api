{{-- Footer Component --}}
<footer class="bg-body border-top" style="padding: 20px 32px;">
    <div class="d-flex justify-content-between align-items-center">
        <small class="text-body-secondary" style="font-size: 13px;">
            © {{ date('Y') }} {{ $appSettings['name_of_health_institute'] ?? 'Antrian Demo' }}. All rights reserved.
        </small>
        <small class="text-body-secondary" style="font-size: 13px;">
            Version 1.0.0
        </small>
    </div>
</footer>
