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
            <h1 class="text-4xl md:text-5xl font-extrabold gradient-header">Cancellation & Refund Policy</h1>
            <p class="text-gray-600 mt-4 text-lg md:text-xl">Learn about our cancellation process and refund terms to keep your experience smooth and transparent.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-6xl mx-auto bg-white mt-10 mb-12 px-6 md:px-10 py-10 shadow-2xl rounded-2xl p-3">

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-purple-600 mb-4">❌ Cancellation Policy</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Users may cancel their orders or listings before the product or service is delivered. Cancellation requests should be submitted as soon as possible to avoid complications.
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg mt-4">
                <li>Cancellations made within 24 hours of purchase are usually fully refundable.</li>
                <li>After 24 hours, cancellations may be subject to review and possible partial refund.</li>
                <li>Some products or services may have specific cancellation restrictions; please review the individual listing details.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-pink-600 mb-4">💸 Refund Policy</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We strive to ensure customer satisfaction. Refunds are processed in accordance with the cancellation policy and after verification of the refund request.
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base md:text-lg mt-4">
                <li>Approved refunds will be credited back to the original payment method within 7-10 business days.</li>
                <li>Refund requests must be made within 14 days of cancellation.</li>
                <li>In case of disputes, our support team will mediate to reach a fair resolution.</li>
            </ul>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-4">🔄 Exchanges & Modifications</h2>
            <p class="text-gray-700 text-base md:text-lg">
                We do not typically offer exchanges, but modifications to orders may be possible before shipment or delivery. Please contact support immediately to discuss any changes.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-red-500 mb-4">⚠️ Exceptions</h2>
            <p class="text-gray-700 text-base md:text-lg">
                Certain products or services, such as digital downloads, custom orders, or non-refundable items, may not be eligible for cancellation or refund. These exceptions will be clearly stated in the product listing.
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-4">📞 Contact Support</h2>
            <p class="text-gray-700 text-base md:text-lg">
                For cancellations, refunds, or any questions, please reach out to our 
                <a href="/contact-us" class="text-blue-600 underline">Customer Support</a>. We’re here to help and ensure your satisfaction.
            </p>
        </section>

        <footer class="pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500 italic">Thank you for your understanding and trust in our platform.</p>
        </footer>

    </div>

</section>
@endsection

@section('customjs')
<!-- You can include page-specific JS here -->
@endsection
