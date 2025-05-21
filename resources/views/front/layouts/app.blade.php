<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Make Listing</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/mystyle.css') }}" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="" /></head>
<body data-instant-intensity="mousedown">
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="/">Make Listing</a>
			
			 {{-- <a class="navbar-brand" href="/">
				<img src="" alt="TravelWith Logo" width="150" height="50">
			</a> --}}
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/">Home</a>
					</li>	
					{{-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">About</a>
                    </li> --}}
	
					{{-- <li class="nav-item">
						<a class="nav-link" aria-current="page" href="">Blogs</a>
					</li>	 --}}
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="">Search</a>
					</li>	
					{{-- <li class="nav-item">
                        <a class="nav-link" href="">Contact Us</a>
                    </li> --}}
									
				</ul>		
				
				<div>
					<a class="btn btn-primary" href="{{ route('account.createTrip') }}" type="submit">Create a Trip</a>
				</div>
				
				

			</div>
		</div>
	</nav>
</header>


@yield('main')



<footer class="bg-dark py-4 bg-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Navigation Links -->
            <div class="col-md-4 text-start">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">Cancellation and refunds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">Terms & Conditions</a>
                    </li>
                </ul>
            </div>
            <!-- Right Side: Social Media Links -->
            <div class="col-md-5 justify-content-end">
                <ul class="nav justify-content-end text-aling-right">
                    {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="https://www.instagram.com/zest_fuljourney?igsh=MXd6eDM1bmczZTk5aA==" target="_blank">Facebook</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="https://www.instagram.com/zest_fuljourney?igsh=MXd6eDM1bmczZTk5aA==" target="_blank">Twitter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="https://www.instagram.com/zest_fuljourney?igsh=MXd6eDM1bmczZTk5aA==" target="_blank">Instagram</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="https://linkedin.com" target="_blank">LinkedIn</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>


        <!-- Centered Copyright -->
        <div class="text-center mt-3">
            <p class="text-white fw-bold fs-6">© 2025 Make Listing, All Rights Reserved</p>
        </div>
    </div>
</footer>


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

{{-- <script>
	 $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

	$("#profilePicForm").submit(function(e) {
		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			url: '{{ route("account.updateProfilePic") }}',
			type: 'post',
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
			success: function(response) {
				if(response.status == false ){
					var errors = response.errors;
					if(errors.image) {
						$("#image-error").html(errors.image)
					}
				} else {
					window.location.href = '{{ url()->current() }}'
				}
				
			}

		});
	});

</script> --}}

@yield('customjs')
</body>
</html>