@extends('front.layouts.app')

@section('main')
<style>
    body {
        font-family: 'Inter', sans-serif;
    }
    .gradient-header {
        background: linear-gradient(90deg, #6366F1, #EC4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<section class="pt-6 md:pt-10 px-4 md:px-0">

    <!-- Hero Section -->
    <div class="bg-white shadow-lg py-12 rounded-xl max-w-6xl mx-auto p-3">
        <div class="max-w-4xl mx-auto text-center px-4 md:px-6">
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-header">Contact Us</h1>
            <p class="text-gray-600 mt-4 text-lg md:text-xl">We’d love to hear from you! Reach out with any questions, feedback, or support needs.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-6xl mx-auto bg-white mt-10 mb-12 px-6 md:px-10 py-10 shadow-2xl rounded-2xl p-3">

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-purple-600 mb-4">📞 Customer Support</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Our support team is here to assist you Monday through Friday, from 9 AM to 6 PM.
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg mt-4">
                <li>Phone: <a href="tel:+1234567890" class="text-blue-600 underline">+1 (234) 567-890</a></li>
                <li>Email: <a href="mailto:support@example.com" class="text-blue-600 underline">support@example.com</a></li>
                <li>Live Chat: Available on our website during business hours</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-pink-600 mb-4">🏢 Our Office</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Visit us or send mail to our headquarters:
            </p>
            <address class="not-italic text-gray-700 text-base md:text-lg mt-2">
                1234 Main Street,<br>
                Suite 500,<br>
                Cityville, State, 12345,<br>
                Country
            </address>
        </section>

        <footer class="pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500 italic">We look forward to connecting with you!</p>
        </footer>

    </div>

</section>
@endsection

@section('customjs')
<!-- You can include page-specific JS here -->
@endsection
