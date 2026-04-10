@extends('layouts.admin')

@section('content')

<div class="container py-5">

    <div class="admin-card p-4">
        <h4 class="mb-4" style="color: var(--primary); font-weight:600;">
            Edit Collection
        </h4>

        <form action="{{ route('admin.collections.update', $collection->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Collection Name</label>
                <input type="text"
                       name="name"
                       value="{{ $collection->name }}"
                       class="form-control"
                       required>
            </div>

<div class="mb-3">
    <label class="form-label">Collection Image</label>

    <div id="drop-area" class="p-4 text-center border rounded" style="cursor:pointer;">
        <p class="mb-2">اسحب الصورة هنا أو اضغط للاختيار</p>
        <input type="file" name="image" id="fileInput" hidden accept="image/*">
        <img id="preview" class="mt-3 w-100 d-none" style="height:200px; object-fit:cover;">
    </div>
</div>

            <button type="submit"
                    class="btn btn-primary-custom w-100 rounded-pill">
                Update Collection
            </button>
        </form>
    </div>

</div>
<script>
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileInput');
const preview = document.getElementById('preview');

dropArea.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', handleFile);

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.style.background = '#f0f0f0';
});

dropArea.addEventListener('dragleave', () => {
    dropArea.style.background = 'transparent';
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    fileInput.files = e.dataTransfer.files;
    handleFile();
});

function handleFile() {
    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection