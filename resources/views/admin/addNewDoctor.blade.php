<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new Doctor') }}
        </h2>
    </x-slot>
    <div class="container mt-4 border">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 mt-4 mb-4">
                <form id='mainForm'>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">name: </label>
                        <input type="text" class="form-control" name="name" placeholder="Doctor name"
                            id="nameText">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email: </label>
                        <input type="text" class="form-control" name="email" placeholder="Doctor Email"
                            id="emailText">
                        <span id="emailError" class="text-danger error-message"></span>
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone number: </label>
                        <input type="text" class="form-control" name="phoneNumber" placeholder="Doctor phone number"
                            id="phoneNumberText">
                        <span id="phoneNumberError" class="text-danger error-message"></span>
                    </div>
                    <div class="mb-3 form-floating input-group">
                        <select name="departmentSelect" class="form-select" id="departmentSelect">
                            <option value="0" disabled selected>Select doctor department</option>
                        </select>
                        <label for="departmentSelect">Department</label>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#depatrmentModal"> Add new department </button>
                    </div>
                    <span id="departmentError" class="text-danger error-message"></span>

                    <div class="mb-3 form-floating input-group">
                        <select name="SpecializationSelect" class="form-select" id="SpecializationSelect">
                            <option value="0" disabled selected>Select doctor specialization</option>
                        </select>
                        <label for="SpecializationSelect">Specialization</label>
                        <span id="specsError" class="text-danger error-message"></span>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#specializationModal" id='addNewSpecialization'>Add new
                            specialization</button>
                    </div>
                    <span id="specsError" class="text-danger error-message"></span>

                    <div class="mb-3 row">
                        <button type="button" name="addSpecialization" class="btn btn-success" id="addDoctor">
                            Add Doctor
                        </button>
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
        var mainForm = $('#mainForm')[0];
        $('#addDoctor').click(function(e) {
            var mainFormData = new FormData(mainForm);
            $.ajax({
                method: "POST",
                url: "{{ route('storeDoctor') }}",
                data: mainFormData,
                processData: false,
                contentType: false,
                success: function(response) {
                    swal("Success", response.success, "success");
                    $('#phoneNumberText').val('');
                    $('#nameText').val('');
                    $('#emailText').val('');
                    $('#departmentSelect').val('');
                    $('#SpecializationSelect').val('');
                    $('#nameError').val('');
                    $('#phoneNumberError').val('');
                    $('#departmentError').val('');
                    $('#emailError').val('');
                    $('#specsError').val('');
                },
                error: function(error) {
                    var name = $('#nameText').val();
                    var phoneNumber = $('#phoneNumberText').val();
                    var email = $('#emailText').val();
                    var dept = $('#departmentSelect').val();
                    var specs = $('#SpecializationSelect').val();

                    if (!name) {
                        $('#nameError').html(error.responseJSON['message']);
                    }
                    if (!phoneNumber) {
                        $('#phoneNumberError').html(error.responseJSON['message']);
                    }
                    if (!email) {
                        $('#emailError').html(error.responseJSON['message']);
                    }
                    if (!dept) {
                        $('#departmentError').html(error.responseJSON['message']);
                    }
                    if (!specs) {
                        $('#specsError').html(error.responseJSON['message']);
                    }
                }
            });

        });
    });
</script>
<script>
    $(document).ready(function() {
        getAllDepartments('departmentSelect');
    });

    $(document).ready(function() {
        var form = $("#deparmentForm")[0];
        $("#addNewDepartment").click(function(e) {
            var deparmentFormData = new FormData(form);
            $.ajax({
                method: 'POST',
                url: "{{ route('storeDepartment') }}",
                processData: false,
                contentType: false,
                data: deparmentFormData,
                success: function(response) {
                    $('#departmentSelect').empty();
                    $('#depatrmentModal').modal('hide');
                    $("#departmentNameText").val('');
                    swal("Success", response.success, "success");
                    getAllDepartments('departmentSelect');
                },
                error: function(error) {
                    if (error) {
                        $('#departmentErrorMessageHolder').html(
                            error.responseJSON['message']);
                    }
                }
            });

        });
    });

    function getAllDepartments(selectName) {
        $.ajax({
            method: "GET",
            url: "{{ route('getAllDepartments') }}",
            dataType: "json",
            success: function(response) {
                for (var i = 0; i < response['data'].length; i++) {
                    var opt = document.createElement('option');
                    opt.value = response['data'][i]['id'];
                    opt.innerHTML = response['data'][i]['name'];
                    $('#' + selectName).prepend(opt);
                }
            }
        });
    }
</script>
<script>
    $('#addNewSpecialization').click(function(e) {
        $('#departmentModalSelect').empty();
        getAllDepartments('departmentModalSelect');

    });

    $(document).ready(function() {
        var spForm = $('#specialization_form')[0];
        $('#addModalNewSpecialization').click(function(e) {
            var spFormData = new FormData(spForm);
            $.ajax({
                method: "POST",
                url: "{{ route('storeDoctorSpecializations') }}",
                data: spFormData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#specializationModal').modal('hide');
                    $("#SpecializationNameText").val('');
                    swal("Success", response.success, "success");
                },
                error: function(error) {
                    if (error) {
                        $('#specErrorMessageHolder').html(
                            error.responseJSON['message']);
                    }
                }
            });
        });
    });

    $('#departmentSelect').change(function() {
        getAllSpecializations();
    });


    function getAllSpecializations() {
        $('#SpecializationSelect').empty();
        var deptId = $('#departmentSelect').val();
        var url = "/getAllSpecializations?id=" + deptId;
        $.ajax({
            method: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                for (var i = 0; i < response['data'].length; i++) {
                    var opt = document.createElement('option');
                    opt.value = response['data'][i]['id'];
                    opt.innerHTML = response['data'][i]['name'];
                    $('#SpecializationSelect').prepend(opt);
                }
            },
            error: function(error) {
                console.log(error.responseJSON);
            }
        });
    }
</script>

<div class="modal fade" id="specializationModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Add new Specialization</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="specialization_form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Specialization name:</label>
                        <input class="form-control" type="text" name="name" id="SpecializationNameText">
                        <span id="specErrorMessageHolder" class="text-danger error-message"></span>
                    </div>
                    <div class="mb-3 form-floating input-group">
                        <select name="departmentModalSelect" class="form-select" id="departmentModalSelect">
                            <option value="0" disabled selected>Select doctor department</option>
                        </select>
                        <label for="departmentSelect">Department</label>
                        <span id="specErrorMessageHolder" class="text-danger error-message"></span>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="addModalNewSpecialization">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="depatrmentModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Add new Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deparmentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Department name:</label>
                        <input class="form-control" type="text" name="name" id="departmentNameText">
                        <span id="departmentErrorMessageHolder" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="addNewDepartment">Add</button>
            </div>
        </div>
    </div>
</div>
