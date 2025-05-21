


@extends('front.layouts.app')

@section('main')


<section class="section-5 bg-2">
    <div class="container py-5">
        
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

                
                <form action="" method="POST" id="createTripForm" name="createTripForm">
                    @csrf
                  
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            {{-- <h3 class="fs-4 mb-1">Create a Trip</h3> --}}
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                
                                <h3 class="fs-4 mb-1">Create a Trip</h3>
                                <div>
                                    <label for="trip_type" class="me-2">Select Trip Type:</label>
                                    <select id="trip_type" name="trip_type" class="form-control d-inline w-auto">
                                        <option value="short" {{ old('trip_type', $trip->trip_type ?? 'short') == 'short' ? 'selected' : '' }}>Short Trip</option>
                                        <option value="long" {{ old('trip_type', $trip->trip_type ?? 'short') == 'long' ? 'selected' : '' }}>Long Trip</option>
                                        
                                    </select>
                                </div>

                                
                                
                            </div>

                            <div>
                                <div class="col-md-6">
                                    <p>Remaining Trips: <strong id="remainingTrips">Loading...</strong></p>
                                </div>
                            </div>
                            
                            <!-- Short Trip Form (Default) -->
                            <div id="short_trip_form" class="">
                                <div class="mb-4">
                                    <label for="title" class="mb-2">Trip Title <span class="req">*</span></label>
                                    <input type="text" placeholder="Trip Title" id="title" name="title" class="form-control">
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="origin" class="mb-2">From <span class="req">*</span></label>
                                        <input type="text" placeholder="Starting Location" id="origin" name="origin" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="destination" class="mb-2">To <span class="req">*</span></label>
                                        <input type="text" placeholder="Destination" id="destination" name="destination" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="start_date" class="mb-2">Start Date <span class="req">*</span></label>
                                        <input type="text" id="start_date" name="start_date" class="form-control datepicker">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="end_date" class="mb-2">End Date <span class="req">*</span></label>
                                        <input type="text" id="end_date" name="end_date" class="form-control datepicker">
                                        <p></p>
                                    </div>
                                </div>

                                <!-- Additional Fields for Short Trip -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="vehicle" class="mb-2">Vehicle Type<span class="req">*</span></label>
                                        <select id="vehicle" name="vehicle" class="form-control">
                                            <option value="car">Car</option>
                                            <option value="bike">Bike</option>
                                            <option value="bus">Bus</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="amount" class="mb-2">Amount Per Person (₹)<span class="req">*</span></label>
                                        <input type="number" id="amount" name="amount" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                               
                                <div class="mb-4">
                                    <label for="persons" class="mb-2">Seat Available<span class="req">*</span></label>
                                    <select id="persons" name="persons" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="10+">10+</option>
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="short_description" class="mb-2">Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" cols="5" rows="5"></textarea>
                                    <p></p>
                                </div>

                               
                            </div>

                            <!-- Long Trip Form (Initially Hidden) -->
                            <div id="long_trip_form" style="display: none;">
                                <div class="mb-4">
                                    <label for="long_title" class="mb-2">Trip Title <span class="req">*</span></label>
                                    <input type="text" placeholder="Trip Title" id="long_title" name="long_title" class="form-control">
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="long_origin" class="mb-2">From <span class="req">*</span></label>
                                        <input type="text" placeholder="Starting Location" id="long_origin" name="long_origin" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="long_destination" class="mb-2">To <span class="req">*</span></label>
                                        <input type="text" placeholder="Destination" id="long_destination" name="long_destination" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="long_start_date" class="mb-2">Start Date <span class="req">*</span></label>
                                        <input type="text" id="long_start_date" name="long_start_date" class="form-control datepicker">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="long_end_date" class="mb-2">End Date <span class="req">*</span></label>
                                        <input type="text" id="long_end_date" name="long_end_date" class="form-control datepicker">
                                        <p></p>
                                    </div>
                                </div>

                                <!-- Additional Fields for Long Trip -->
                                <div class="mb-4">
                                    <label for="age" class="mb-2">Your Age <span class="req">*</span></label>
                                    <input type="number" id="age" name="age" class="form-control" placeholder="Enter your age">
                                    <p></p>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="facebook_url" class="mb-2">Facebook Profile</label>
                                    <input type="url" id="facebook_url" name="facebook_url" class="form-control" placeholder="Facebook Profile URL">
                                    <p></p>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="instagram_url" class="mb-2">Instagram Profile</label>
                                    <input type="url" id="instagram_url" name="instagram_url" class="form-control" placeholder="Instagram Profile URL">
                                    <p></p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="smoke" class="mb-2">Do You Smoke? <span class="req">*</span></label>
                                        <select id="smoke" name="smoke" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>
                                
                                    <div class="col-md-6 mb-4">
                                        <label for="drink" class="mb-2">Do You Drink? <span class="req">*</span></label>
                                        <select id="drink" name="drink" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>
                                

                                </div>
                                <div class="row">
                                  
                                    <div class="col-md-6 mb-4">
                                        <label for="food_preference" class="mb-2">Food Preference <span class="req">*</span></label>
                                        <select id="food_preference" name="food_preference" class="form-control">
                                            <option value="">Select</option>
                                            <option value="veg">Veg</option>
                                            <option value="non-veg">Non-Veg</option>
                                        </select>
                                        <p></p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label for="swimming_pool" class="mb-2">Swimming Pool?<span class="req">*</span></label>
                                        <select id="swimming_pool" name="swimming_pool" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="night_party" class="mb-2">night_party? <span class="req">*</span></label>
                                        <select id="night_party" name="night_party" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>
                                
                                    <div class="col-md-6 mb-4">
                                        <label for="bike_ride" class="mb-2">bike_ride? <span class="req">*</span></label>
                                        <select id="bike_ride" name="bike_ride" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                               

                                
                                <div class="mb-4">
                                    <label for="long_description" class="mb-2">Description</label>
                                    <textarea class="form-control" name="long_description" id="long_description" cols="5" rows="5"></textarea>
                                    <p></p>
                                </div>
                            
                         
                            </div>

                           
                            
                        </div> 
                          
                            <div class="card-footer p-4">
                                <button id="saveTripBtn" type="submit" class="btn btn-primary">Post a Trip</button>
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
    $(document).ready(function() {
    // Show or hide trip type forms based on selection
    function toggleTripType() {
        if ($("#trip_type").val() === "short") {
            $("#short_trip_form").show();
            $("#long_trip_form").hide();
        } else {
            $("#short_trip_form").hide();
            $("#long_trip_form").show();
        }
    }


    $("#trip_type").change(toggleTripType);
    toggleTripType(); // Ensure correct form is shown on page load
});

});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let tripType = document.getElementById("trip_type").value;
        
        // Show/hide forms based on selected trip type
        toggleTripForms(tripType);
    
        document.getElementById("trip_type").addEventListener("change", function () {
            toggleTripForms(this.value);
        });
    
        function toggleTripForms(type) {
            document.getElementById("short_trip_form").style.display = (type === "short") ? "block" : "none";
            document.getElementById("long_trip_form").style.display = (type === "long") ? "block" : "none";
        }
    });
    </script>
    



{{-- code for 3 long 3 short trips  --}}
<script>
    $(document).ready(function () {
        // Fetch trip limit information
        $.get('/account/trip-limit', function (data) {
            let remainingShort = data.remainingShortTrips;
            let remainingLong = data.remainingLongTrips;

            // Display remaining trips
            $('#remainingTrips').text(`Short: ${remainingShort}, Long: ${remainingLong}`);

            // Reset button state first
            $('#saveTripBtn').prop('disabled', false).text('Post a Trip');
            $('#upgradeMessage').hide();

            // Disable Short Trip Button if Limit Reached
            if (data.isShortTripsLimited && $('#trip_type').val() === "short") {
                $('#saveTripBtn').prop('disabled', true).text('Upgrade to Add More Short Trips');
                $('#upgradeText').text('You have used all your free short trips.');
                $('#upgradeMessage').show();
            }

            // Disable Long Trip Button if Premium is Required
            if (data.isLongTripsLimited && $('#trip_type').val() === "long") {
                $('#saveTripBtn').prop('disabled', true).text('Only Premium Users Can Post Long Trips');
                $('#upgradeText').text('Long trips are only for premium users.');
                $('#upgradeMessage').show();
            }

            // Change button behavior dynamically
            $('#trip_type').on('change', function () {
                let selectedTripType = $(this).val();

                $('#saveTripBtn').prop('disabled', false).text('Post a Trip');
                $('#upgradeMessage').hide();

                if (selectedTripType === "long" && data.isLongTripsLimited) {
                    $('#saveTripBtn').prop('disabled', true).text('Only Premium Users Can Post Long Trips');
                    $('#upgradeText').text('Long trips are only for premium users.');
                    $('#upgradeMessage').show();
                } 
                if (selectedTripType === "short" && data.isShortTripsLimited) {
                    $('#saveTripBtn').prop('disabled', true).text('Upgrade to Add More Trips');
                    $('#upgradeText').text('You have used all your free short trips.');
                    $('#upgradeMessage').show();
                }
            });

        });
    });
</script>



<script type="text/javascript">
$("#createTripForm").submit(function(e){
    e.preventDefault();
    $("button[type='submit']").prop('disabled',true);


    $.ajax ({
        url: '{{ route("account.saveTrip") }}',
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
               window.location.href="{{ route('account.myTrips') }}"
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

</script>

@endsection