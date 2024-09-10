@extends('backend.master')

@section('title', 'Blogs')

@section('content')
    <div class="card">
        <div class="card-body table-responsive p-0" id="table_data">

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            fetch_data(1);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "{{ route('backend.admin.blog.data') }}?page=" + page,
                success(response) {
                    $('#table_data').html(response);
                }
            });
        }
    </script>
@endpush
