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
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-header">Privacy Policy</h1>
            <p class="text-gray-600 mt-4 text-lg md:text-xl">Your privacy is important to us. This policy explains how we handle your data with care and responsibility.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-6xl mx-auto bg-white mt-10 mb-12 px-6 md:px-10 py-10 shadow-2xl rounded-2xl p-3">

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-purple-600 mb-4">🔐 Information We Collect</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We collect personal information such as your name, email address, and other contact details when you register, list a product, or contact us. We also gather technical information like browser type and IP address to improve user experience.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-pink-600 mb-4">📦 How We Use Your Information</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg">
                <li>To personalize your experience and provide relevant content.</li>
                <li>To process transactions and manage product listings.</li>
                <li>To send updates, offers, and communication regarding our services.</li>
                <li>To improve website performance and customer support.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-4">🔄 Sharing & Disclosure</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We do not sell or trade your personal information. Data may be shared with trusted third parties for operations like payment processing, but only under strict confidentiality agreements.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-red-500 mb-4">🔒 Data Security</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We implement various security measures to protect your data, including encryption and secure server storage. However, no method of transmission over the Internet is 100% secure.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-4">📄 Your Rights</h2>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg">
                <li>You have the right to access, update, or delete your personal data.</li>
                <li>You may opt out of promotional communications at any time.</li>
                <li>To exercise your rights, please contact us using the information below.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-yellow-500 mb-4">📅 Changes to This Policy</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We may update this Privacy Policy from time to time. Changes will be posted on this page with a revised effective date.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-500 mb-4">📬 Contact Information</h2>
            <p class="text-gray-700 text-base md:text-lg">
                If you have any questions about this Privacy Policy, feel free to reach out via our 
                <a href="/contact-us" class="text-blue-600 underline">Contact Us</a> page.
            </p>
        </section>

        <footer class="pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500 italic">We value your trust and are committed to protecting your personal data.</p>
        </footer>

    </div>

</section>
@endsection

@section('customjs')
<!-- You can include page-specific JS here -->
@endsection
