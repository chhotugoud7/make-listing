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
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-header">About Us</h1>
            <p class="text-gray-600 mt-4 text-lg md:text-xl">Empowering sellers and simplifying product listings across all categories.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-6xl mx-auto bg-white mt-10 mb-12 px-6 md:px-10 py-10 shadow-2xl rounded-2xl p-3">

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-purple-600 mb-4">🌐 What We Do</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg">
                <li>Enable users to list their products or services easily and quickly.</li>
                <li>Allow visitors to browse listings by category, keyword, or location.</li>
                <li>Provide a seamless, mobile-friendly interface for sellers and buyers.</li>
                <li>Offer secure communication and listing management tools.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-pink-600 mb-4">🚀 Our Mission</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Our mission is to simplify how products and services are listed online.
                We aim to become the leading platform for showcasing products, enabling businesses and individuals to grow their presence with ease and professionalism.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-4">🛍️ Who Can Use This Website?</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg">
                <li>Small businesses promoting physical or digital products.</li>
                <li>Freelancers offering services locally or globally.</li>
                <li>Startups showcasing their MVPs or early-stage products.</li>
                <li>Individuals listing used items or community offers.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-red-500 mb-4">🔒 Transparency & Trust</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We are committed to building a trustworthy platform. All listings go through moderation, and we ensure open, fair, and respectful communication between users.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-4">📞 Contact Us</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Need help or want to share your feedback? Visit our 
                <a href="/contact-us" class="text-blue-600 underline">Contact Us</a> page. We’re always here to support you.
            </p>
        </section>

        <footer class="pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500 italic">Thank you for choosing us to list and grow your products online.</p>
        </footer>
    </div>

</section>
@endsection

@section('customjs')
<!-- You can include page-specific JS here -->
@endsection
