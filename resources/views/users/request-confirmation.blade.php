@can('user-access')
    @extends('layouts.Users.app')

    @section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Send a Verification Request</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('users.requests.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <div class="dropzone border border-primary rounded text-center py-5 d-flex justify-content-center align-items-center flex-column" id="dropzone" style="cursor: pointer; position: relative;">
                                    <img src="{{ asset('logo/file-logo.jpg') }}" alt="Logo" style="height: 50px; margin-bottom: 10px;">
                                    <span>Drag & Drop files here or click to select files</span>
                                    <input type="file" name="proofFiles[]" id="fileInput" class="d-none" multiple>
                                </div>
                                <div class="mt-3" id="filePreviewContainer" style="display: none;">
                                    <p><strong>File Preview:</strong></p>
                                    <div id="filePreview" class="border border-secondary rounded p-2 d-flex flex-wrap"></div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-success" type="submit">Submit Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dropzone = document.getElementById('dropzone');
            let fileInput = document.getElementById('fileInput');
            let filePreviewContainer = document.getElementById('filePreviewContainer');
            let filePreview = document.getElementById('filePreview');

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('bg-light');
            });

            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('bg-light');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('bg-light');

                let files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    showFilePreviews(files);
                }
            });

            dropzone.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    showFilePreviews(fileInput.files);
                }
            });

            function showFilePreviews(files) {
                filePreviewContainer.style.display = 'block';
                filePreview.innerHTML = '';

                Array.from(files).forEach(file => {
                    let filePreviewItem = document.createElement('div');
                    filePreviewItem.classList.add('p-2');
                    filePreviewItem.style.width = '100px';

                    if (file.type.startsWith('image/')) {
                        let img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = '100%';
                        img.style.height = 'auto';
                        img.onload = function() {
                            URL.revokeObjectURL(this.src);
                        }
                        filePreviewItem.appendChild(img);
                    } else {
                        let fileDetails = document.createElement('div');
                        fileDetails.innerHTML = `<p>${file.name}</p><p>${(file.size / 1024).toFixed(2)} KB</p>`;
                        filePreviewItem.appendChild(fileDetails);
                    }

                    filePreview.appendChild(filePreviewItem);
                });
            }
        });
    </script>

    @endsection
@endcan
