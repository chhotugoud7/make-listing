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
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-header">Terms & Conditions</h1>
            <p class="text-gray-600 mt-4 text-lg md:text-xl">Please read these terms and conditions carefully before using our service.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-6xl mx-auto bg-white mt-10 mb-12 px-6 md:px-10 py-10 shadow-2xl rounded-2xl p-3">

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-purple-600 mb-4">📋 Acceptance of Terms</h2>
            <p class="text-gray-700 text-base md:text-lg">
                By accessing and using our website or services, you agree to be bound by these Terms & Conditions and all applicable laws and regulations.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-pink-600 mb-4">🔒 User Responsibilities</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg">
                <li>You must provide accurate and complete information when using our services.</li>
                <li>It is your responsibility to maintain the confidentiality of your account details.</li>
                <li>Any misuse or violation of these terms may result in suspension or termination of your account.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-4">⚖️ Intellectual Property</h2>
            <p class="text-gray-700 text-base md:text-lg">
                All content, trademarks, and intellectual property on this site are owned by or licensed to us. Unauthorized use is prohibited.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-red-500 mb-4">❗ Limitation of Liability</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We are not liable for any direct, indirect, incidental, or consequential damages arising from the use or inability to use our services.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-4">🔄 Changes to Terms</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We reserve the right to modify these Terms & Conditions at any time. Changes will be effective immediately upon posting on the website.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-yellow-500 mb-4">📞 Contact Us</h2>
            <p class="text-gray-700 text-base md:text-lg">
                If you have any questions about these Terms & Conditions, please visit our 
                <a href="/contact-us" class="text-blue-600 underline">Contact Us</a> page.
            </p>
        </section>

        <footer class="pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500 italic">Thank you for using our services responsibly.</p>
        </footer>

    </div>

</section>
@endsection

@section('customjs')
<!-- You can include page-specific JS here -->
@endsection
