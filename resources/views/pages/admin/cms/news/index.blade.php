@extends('layouts.app')

@section('content')
    <div class="card-body py-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></span>
                <input type="text" data-kt-user-table-filter="search" data-table-id="news-table"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Search News" id="mySearchInput" />
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-news_modal" id="createNewNews">
               <i class="fal fa-plus fs-3"></i>
                <span class="ms-2">
                Add News
               </span>
            </button>
        </div>
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>


    @include('pages.admin.cms.news.modal')

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            const tableId = 'news-table';

            $(document).ready(function() {
                $('[data-kt-user-table-filter="search"]').on('input', function() {
                    window.LaravelDataTables[`${tableId}`].search($(this).val()).draw();
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $('#createNewNews').click(function() {
                $('#savedata').val("create-news");
                $('#id').val('');
                $('#add-news_modal-form').trigger("reset");
                $('#add-news_modal').modal('show');
                $('#updated_bydiv').addClass('d-none');
            });

            $('body').on('click', '.editNews', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.cms.news.index') }}" + '/' + id + '/edit', function(data) {
                    $('#updated_bydiv').removeClass('d-none');
                    $('#savedata').val("edit-news");
                    $('#add-news_modal').modal('show');
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').summernote('code', data.description);
                    $('#created_by').val(data.created_by);
                    $('#updated_by').val(data.updated_by);
                })
            });

            $('#savedata').click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: $('#add-news_modal-form').serialize(),
                    url: "{{ route('admin.cms.news.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        $('#add-news_modal-form').trigger("reset");
                        $('#add-news_modal').modal('hide');
                        window.LaravelDataTables[`${tableId}`].draw();
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            }
                        });
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            showValidationErrors(response.responseJSON.errors);
                        } else {
                            Swal.fire({
                                text: "Something went wrong. Please try again.",
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Close',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                }
                            });
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
