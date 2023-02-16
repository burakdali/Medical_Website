<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>

        <button type="button" class="btn btn-success" id="addNewCategory">Add new Category</button>

    </x-slot>
    <div class="container mt-5">
        <div class="row mt-5" id="rowDiv">
            <?php foreach ($categories as $index) : ?>

            <div class="col-4">
                <div class="card mt-4">
                    <div class="card-header">
                        Category id: <span class="fw-bold" id="catId"><?php echo $index['id']; ?></span>
                    </div>
                    <div class="card-body" id="cardBody">
                        <h5 class="h5">
                            <span class="text-muted">Category name: </span>
                            <span class="fst-italic fw-bold" id="catName"><?php echo $index['cat_name']; ?></span>
                        </h5>
                        <h5 class="h5">
                            <span class="text-muted"> Creation date: </span>
                            <span class="fst-italic fw-bold"><?php echo $index['created_at']; ?></span>
                        </h5>
                        <ul class="list-inline mt-4">
                            <li class="list-inline-item">

                                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit Category
                                </button>

                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="ModalLabel">Edit this category</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="/editCategory?id=<?php echo $index['id']; ?>" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="cat_name" class="col-form-label">Category
                                                            name:</label>
                                                        <input class="form-control" type="text" name="cat_name"
                                                            value="<?php echo $index['cat_name']; ?>">
                                                        <span id="errorMessageHolder"
                                                            class="text-danger error-message"></span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="liveAlertBtn">Edit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-outline-danger m-2" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            Delete Category
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this category?!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <form action="/deleteCategory?id=<?php echo $index->id; ?>" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete it</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    </div>
</x-app-layout>

@if (Session::has('success'))
    <script>
        swal("Success", "Category has been edited succesfully", "success");
    </script>
@endif
@if (Session::has('deleted'))
    <script>
        swal("Success", "Category deleted successfully", "success");
    </script>
@endif

<script></script>

{{-- <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('getCategories') }}",
            dataType: "json",
            success: function(response) {
                for (var i = 0; i < response['data'].length; i++) {
                    $("#rowDiv").append(
                        $('<div/>').addClass("col-4")
                        .append('<div/>').addClass("card mt-4")
                        .append('<div/>').addClass("card-header")
                        .append('<span/>').addClass("fw-bold").text(response["data"][i][
                            "id"
                        ]);
                    );
                }
            }
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
        var form = $('#cardForm')[0];
        $('#btnDelete').click(function() {
            var formData = new FormData(form);
            $.ajax({
                url: '{{ route('deleteCategory') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    console.log('success');
                },
                error: function(error) {
                    console.log('Error');
                },
            })
        });
    });
</script> --}}
