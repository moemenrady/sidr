@extends('layouts.admin')

@section('title', 'Edit Site Cover')

@section('style')
<style>
    .admin-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .preview-container {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: .2s;
    }

    .preview-container:hover {
        border-color: #357D73;
        background: #f3f4f6;
    }

    .preview-img {
        max-height: 300px;
        object-fit: cover;
        border-radius: 10px;
        width: 100%;
    }

    .btn-primary-custom {
        background: #357D73;
        color: white;
        border-radius: 25px;
        padding: 8px 25px;
        transition: .2s;
    }

    .btn-primary-custom:hover {
        background: #2a645c;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Edit Site Cover (Desktop & Mobile)</h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Desktop Version --}}
            <div class="col-md-8 mb-4">
                <div class="admin-card p-4">
                    <h5 class="mb-3">Desktop Cover (Wide)</h5>
                    <div class="mb-3">
                        <img src="{{ asset('home/base_image_desktop.png') }}?v={{ time() }}" 
                             class="preview-img shadow-sm mb-3" id="currentDesktop" alt="Desktop">
                    </div>
                    
                    <div class="preview-container" onclick="document.getElementById('desktopInput').click()">
                        <p class="text-muted mb-0">Click to upload New Desktop Image</p>
                        <img id="previewDesktop" class="preview-img d-none mt-2" alt="Preview">
                    </div>
                    <input type="file" id="desktopInput" name="desktop_image" accept="image/*" hidden onchange="previewFile(event, 'previewDesktop')">
                    @error('desktop_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Mobile Version --}}
            <div class="col-md-4 mb-4">
                <div class="admin-card p-4">
                    <h5 class="mb-3">Mobile Cover (Portrait)</h5>
                    <div class="mb-3 text-center">
                        <img src="{{ asset('home/base_image_mobile.png') }}?v={{ time() }}" 
                             class="preview-img shadow-sm mb-3" style="max-width: 200px; height: 350px; object-fit: cover;" id="currentMobile" alt="Mobile">
                    </div>

                    <div class="preview-container" onclick="document.getElementById('mobileInput').click()">
                        <p class="text-muted mb-0">Click for Mobile Image</p>
                        <img id="previewMobile" class="preview-img d-none mt-2" style="max-height: 200px" alt="Preview">
                    </div>
                    <input type="file" id="mobileInput" name="mobile_image" accept="image/*" hidden onchange="previewFile(event, 'previewMobile')">
                    @error('mobile_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        <div class="admin-card p-3 text-center">
            <button type="submit" class="btn btn-primary-custom btn-lg">Save All Changes</button>
        </div>
    </form>
</div>
@endsection


@push('scripts')
<script>
function previewFile(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush