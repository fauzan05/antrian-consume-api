{{-- Admin Footer Component --}}
<footer class="bg-body border-top mt-auto">
    <div class="container-fluid px-4 py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <small class="text-body-secondary" style="font-size: 13px;">
                © {{ date('Y') }} {{ $appSettings['name_of_health_institute'] ?? 'Admin Dashboard' }}. All rights reserved.
            </small>
            <div class="d-flex align-items-center gap-3">
                <small class="text-body-secondary" style="font-size: 13px;">
                    <i class="fas fa-code me-1"></i> Version 2.0.0
                </small>
                <span class="text-body-secondary">•</span>
                <small class="text-body-secondary" style="font-size: 13px;">
                    Made with <i class="fas fa-heart text-danger"></i> by Admin Team
                </small>
            </div>
        </div>
    </div>
</footer>

@push('css')
<style>
    footer {
        position: relative;
        z-index: 1;
    }
    
    footer small {
        line-height: 1.5;
    }
</style>
@endpush
