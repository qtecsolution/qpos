<div class="d-flex justify-content-between">
    <h3>Edit "<u>{{ $page->title }}</u>" Page</h3>
    <i class="fas fa-window-close fa-lg" type="button" onclick="closeForm()"></i>
</div>

<form method="post" action="{{ route('backend.admin.update.page') }}" id="edit-page-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $page->id }}">

    <div class="row">
        <div class="col-6 mb-3">
            <div class="form-group">
                <label for="title" class="form-label">Page Title <span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" required autocomplete="off" name="title"
                    placeholder="Enter title" value="{{ $page->title }}">
            </div>
        </div>

        <div class="col-6 mb-3">
            <div class="form-group">
                <label for="name" class="form-label">Slug<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" required autocomplete="off" name="slug"
                    placeholder="Enter slug" value="{{ $page->slug }}" readonly>
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="form-group">
            <label for="thumbnail">
                Thumbnail
                @if ($page->thumbnail)
                    |
                    <a href="{{ route('backend.admin.delete.page.img', $page->id) }}" class="text-danger">
                        Delete Thumbnail
                    </a>
                @endif
            </label>
            <br>
            <img class="img-fluid thumbnail-preview m-1" src="{{ $page->thumb_null }}" alt="{{ $page->title }}">
            <input type="file" class="form-control" name="thumbnail" onchange="previewThumbnail(this)">
        </div>
    </div>

    <div class="form-group">
        <label for="content">
            Content
            <span class="text-danger">*</span>
        </label>
        <textarea class="summerNote" placeholder="Enter content" name="content" cols="30" rows="10" id="content">{{ $page->content }}</textarea>
        <p class="text-danger d-none" id="content-error">
            * content field is required
        </p>
    </div>

    <div class="col-12 mb-3">
        <p></p>
        <div class="form-group">
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="publish" name="status"
                    {{ $page->status ? 'checked' : '' }}>
                <label class="custom-control-label" for="publish">
                    Active
                </label>
            </div>
        </div>
    </div>
    <div class="generate-btn-wrapper">
        <button type="submit" class="btn btn-block bg-gradient-primary">
            Submit
        </button>
    </div>
</form>

<script src="{{ asset('js/page-builder-script.js') }}"></script>

<script>
    document
        .getElementById("edit-page-form")
        .addEventListener("submit", function(event) {
            var contentValue = document.getElementById("content").value;

            if (contentValue.trim() === "") {
                event.preventDefault();

                // Throw an exception or display an error message
                document.getElementById("content-error").classList.remove("d-none");
            }
        });
</script>
