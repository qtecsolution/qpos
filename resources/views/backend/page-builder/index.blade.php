@extends('backend.master')

@section('title', 'Page Builder')

@section('content')
    <div class="card">
        <div class="card-body p-2 p-md-4 pt-0">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="text-right">
                            <button type="button" class="btn bg-gradient-primary" onclick="load_create_form()">
                                <i class="fas fa-plus-circle"></i>
                                Add New
                            </button>
                        </div>
                        <div class="card-body table-responsive p-0" id="table_data">

                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12" id="form_section">

                    </div>
                </div>
            </div>
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
                url: "{{ route('backend.admin.page.data') }}?page=" + page,
                success(response) {
                    $('#table_data').html(response);
                }
            });
        }

        function load_create_form() {
            $.ajax({
                url: "{{ route('backend.admin.page.load.create.form') }}",
                success(response) {
                    $('#form_section')
                        .css('background-color', 'yellow')
                        .animate({
                            backgroundColor: 'transparent'
                        }, 1000, function() {
                            $(this).css('background-color', '');
                        });

                    $('#form_section').html(response);
                }
            });
        }

        function closeForm() {
            $('#form_section').html('');
        };
    </script>
@endpush
