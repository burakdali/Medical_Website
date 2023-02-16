<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new article') }}
        </h2>
    </x-slot>

    <div class="container mt-4 border">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 mt-4 mb-4">
                <form id="frmAddNewArticle">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="your article title"
                            id="titleText">
                        <span id="titleError" class="text-danger error-message"></span>

                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" name="content" rows="5" id="contentText"></textarea>
                        <span id="contentError" class="text-danger error-message"></span>
                    </div>
                    <div class="mb-3 form-floating input-group">
                        <select name="categories" class="form-select" id="floatingSelect">
                            <option value="0" disabled selected>Select your category</option>
                        </select>
                        <label for="floatingSelect">Categories</label>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#categoryModal" data-bs-whatever="@mdo">Add new Category</button>
                    </div>
                    <div class="mb-3 row">
                        <button type="button" name="addArticle" class="btn btn-success" id="btnAddNewArticle">Add this
                            Article</button>
                    </div>
                </form>

            </div>
            <div class="col-1"></div>
        </div>
    </div>
</x-app-layout>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(document).ready(function() {
        getAllCategories();
        var form = $('#cat_form')[0];
        $('#addNewCategory').click(function() {
            var formData = new FormData(form);
            $('.error-message').html('');
            $.ajax({
                url: '{{ route('category_store') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $('#floatingSelect').empty();
                    $('#categoryModal').modal('hide');
                    $('#catNameText').val('');
                    swal("Success", response.success, "success");
                    getAllCategories();
                },
                error: function(error) {
                    if (error) {
                        $('#errorMessageHolder').html('This Field Cannot be EMPTY...');
                    }
                },
            });
        });
    });

    $(document).ready(function() {
        var addForm = $('#frmAddNewArticle')[0];
        $('#btnAddNewArticle').click(function() {
            var addFormData = new FormData(addForm);
            $.ajax({
                url: '{{ route('storeArticle') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: addFormData,
                success: function(response) {
                    $('#contentText').val('');
                    $('#titleText').val('');
                    $('#floatingSelect').val([]);
                    $('#titleError').val('');
                    $('#contentError').val('');
                    swal("Success", response.success, "success");
                },
                error: function(error) {
                    if (error) {
                        var title = $('#titleText').val();
                        var content = $('#contentText').val();
                        if (!title) {
                            $('#titleError').html(error.responseJSON['message']);
                        }
                        if (!content) {
                            $('#contentError').html(error.responseJSON['message']);
                        }

                    }
                },
            });
        });
    });


    function getAllCategories() {
        $.ajax({
            url: '{{ route('getCategories') }}',
            method: 'GET',
            datatype: 'json',
            success: function(response) {
                var elementCount = response['data'].length;
                for (var i = 0; i < elementCount; i++) {
                    var opt = document.createElement('option');
                    opt.value = response['data'][i]['id'];
                    opt.innerHTML = response['data'][i]['cat_name'];
                    $('#floatingSelect').prepend(opt);
                }
            },
        });
    }
</script>
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Add new Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cat_form">
                    @csrf
                    <div class="mb-3">
                        <label for="cat_name" class="col-form-label">Category name:</label>
                        <input class="form-control" type="text" name="cat_name" id="catNameText">
                        <span id="errorMessageHolder" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="addNewCategory">Add</button>
            </div>
        </div>
    </div>
</div>
