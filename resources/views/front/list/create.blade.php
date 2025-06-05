


@extends('front.layouts.app')

@section('main')


<section class="section-5 bg-2">
    <div class="container py-5 ">
        
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">make a list</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-9">

                @include('front.message')

                
                 <form action="{{ route('savePost') }}" method="POST" enctype="multipart/form-data" id="createPostForm">
                    @csrf

                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-4">Create New Listing</h3>

                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="mb-2">Business Name <span class="req">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" required>
                                <p></p>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="mb-2">Description <span class="req">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                                <p></p>
                            </div>

                            <!-- Category & Subcategory -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="category_id" class="mb-2">Category <span class="req">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="subcategory_id" class="mb-2">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        <!-- Subcategories will be loaded via JS based on category -->
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <!-- Location: Country > State > City -->
                            <div class="mb-4">
                            <label for="location" class="mb-2">Location <span class="req">*</span></label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Enter full address or area" required>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                                <p></p>
                            </div>

                            <!-- Price -->
                           {{-- <div class="mb-4">
                                <label for="price" class="mb-2">Price (₹)</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter price">
                                <p></p>
                            </div> --}}

                            <!-- Image Uploads -->
                            <div class="mb-4">
                                <label for="images" class="mb-2">Upload Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <p></p>
                            </div>

                            {{-- <div class="mb-4">
                                <label for="contact_name" class="mb-2">Your Name <span class="req">*</span></label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control" required>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="mb-2">Email Address <span class="req">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                                <p></p>
                            </div> --}}

                            <div class="mb-4">
                                <label for="phone" class="mb-2">Phone Number <span class="req">*</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control" required>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="tags" class="mb-2">Tags (optional)</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. mobile, second-hand, Samsung">
                                <p></p>
                            </div>



                        </div>

                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Submit Listing</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>










@endsection


@section('customjs')


<script>
$(document).ready(function() {
    $('#category_id').on('change', function() {
        let categoryId = $(this).val();
        if(categoryId) {
            $.ajax({
                url: '/subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                    $.each(data, function(key, subcategory) {
                        $('#subcategory_id').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                    });
                },
                error: function() {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">No subcategories found</option>');
                }
            });
        } else {
            $('#subcategory_id').empty();
            $('#subcategory_id').append('<option value="">Select Subcategory</option>');
        }
    });
});
</script>




<script>
    $(document).ready(function() {

    // Datepicker settings
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: 0
    });

    // Prevent manual typing in date fields
    $(".datepicker").on("keydown", function(e) {
        e.preventDefault();
    });
 

});

</script>

    

<script type="text/javascript">
$('#createPostForm').submit(function(e){
    e.preventDefault();
    $("button[type='submit']").prop('disabled', true);

    var formData = new FormData(this);

    
    $.ajax({
    url: '{{ route("savePost") }}',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
     success: function(response) {

        console.log("AJAX Response:", response); // Add this


            if (response.status === true) {
                // Remove validation feedback if present
                $(".form-control").removeClass('is-invalid');
                $("p").removeClass('invalid-feedback').html('');

                // Redirect after successful submission
                window.location.href = "{{ route('makeListing') }}";
            } else {
                // Re-enable submit button
                $("button[type='submit']").prop('disabled', false);

                // Handle validation errors
                var errors = response.errors;
                for (var field in errors) {
                    $("#" + field).addClass('is-invalid');
                    $("#" + field).next("p").addClass('invalid-feedback').html(errors[field][0]);
                }
            }
        },
    error: function(xhr) {
            console.log('Server Error:', xhr);
            $("button[type='submit']").prop('disabled', false);
        }
});

});
</script>



{{-- 

<script type="text/javascript">
$("#createTripForm").submit(function(e){
    e.preventDefault();
    $("button[type='submit']").prop('disabled',true);


    $.ajax ({
        url: '',
        type: 'POST', 
        dataType: 'json',
        data: $("#createTripForm").serialize() + "&_method=POST&_token={{ csrf_token() }}",
        // data: $("#createTripForm").serializeArray(),
        // data: $("#createTripForm").serializeArray(), 
        success: function(response) {
            $("button[type='submit']").prop('disabled',false);


            if(response.status == true) {

                $("#title").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#origin").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#destination").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')  

                $("#start_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#end_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')    
                $("#vehicle").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')    
                $("#amount").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')    
                $("#persons").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')    
                // $("#description").removeClass('is-invalid')
                //     .siblings('p')
                //     .removeClass('invalid-feedback')
                //     .html('')    
                $("#short_description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                // for long trip 
                $("#long_title").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                    
                $("#long_origin").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#long_destination").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#long_start_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#long_end_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#age").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#smoke").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#drink").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#food_preference").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#night_party").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#bike_ride").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                $("#swimming_pool").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')

                $("#long_description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')


                // location.reload();
               window.location.href=""
            } else {
                var errors = response.errors;

               
                if (errors.title) {
                $("#title").addClass('is-invalid')
                    .closest('.mb-4') // Selects the closest parent div with class 'mb-4'
                    .find('p') // Finds the <p> inside
                    .addClass('invalid-feedback')
                    .html(errors.title);
                } else {
                    $("#title").removeClass('is-invalid')
                        .closest('.mb-4')
                        .find('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }

                if (errors.origin) {
                $("#origin").addClass('is-invalid')
                    .closest('.mb-4') // Selects the closest parent div with class 'mb-4'
                    .find('p') // Finds the <p> inside
                    .addClass('invalid-feedback')
                    .html(errors.origin);
                } else {
                    $("#origin").removeClass('is-invalid')
                        .closest('.mb-4')
                        .find('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }


                if(errors.destination){
                    $("#destination").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.destination)
                } else {
                    $("#destination").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }



                if(errors.start_date){
                    $("#start_date").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.start_date)
                } else {
                    $("#start_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if(errors.end_date){
                    $("#end_date").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.end_date)
                } else {
                    $("#end_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if(errors.short_description){
                    $("#short_description").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.short_description)
                    .html('The discription field is required.')
                } else {
                    $("#short_description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
               

                if(errors.amount){
                    $("#amount").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors.amount)
                } else {
                    $("#amount").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

               


                // long trips error handling 
                if(errors.long_title){
                    $("#long_title").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_title)
                    .html('The title field is required.')
                } else {
                    $("#long_title").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }  
                
                if(errors.long_origin){
                    $("#long_origin").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_origin)
                    .html('The origin field is required.')
                } else {
                    $("#long_origin").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }

                if(errors.long_destination){
                    $("#long_destination").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_destination)
                    .html('The destination field is required.')
                } else {
                    $("#long_destination").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.long_start_date){
                    $("#long_start_date").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_start_date)
                    .html('The start date field is required.')
                } else {
                    $("#long_start_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.long_end_date){
                    $("#long_end_date").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_end_date)
                    .html('The end date field is required.')
                } else {
                    $("#long_end_date").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.age){
                    $("#age").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.age)
                    .html('The age field is required.')
                } else {
                    $("#age").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.smoke){
                    $("#smoke").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.smoke)
                    .html('The smoke field is required.')
                } else {
                    $("#smoke").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.food_preference){
                    $("#food_preference").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.food_preference)
                    .html('The food preference field is required.')
                } else {
                    $("#food_preference").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }
                
                if(errors.night_party){
                    $("#night_party").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.night_party)
                    .html('The night party field is required.')
                } else {
                    $("#night_party").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }   
               

                
                if(errors.drink){
                    $("#drink").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.drink)
                    .html('The drink field is required.')
                } else {
                    $("#drink").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }   
               

                
                if(errors.bike_ride){
                    $("#bike_ride").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.bike_ride)
                    .html('The bike ride field is required.')
                } else {
                    $("#bike_ride").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }   
               
                if(errors.swimming_pool){
                    $("#swimming_pool").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.swimming_pool)
                    .html('The swimming pool field is required.')
                } else {
                    $("#swimming_pool").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }   
               

                
                if(errors.long_description){
                    $("#long_description").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    // .html(errors.long_description)
                    .html('The description field is required.')
                } else {
                    $("#long_description").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('')
                }   
               


            }
        },
    });
});

</script> --}}

@endsection