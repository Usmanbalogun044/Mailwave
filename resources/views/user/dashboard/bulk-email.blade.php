@extends('user.layouts.user')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Send Bulk Email</h2>

    <form action="{{ route('bulk-email.send') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Upload File -->
        <label class="block text-sm font-medium text-gray-700">Upload Email List (CSV, TXT, Excel)</label>
        <input type="file" name="email_file" class="w-full border rounded p-2 mt-1 mb-4" accept=".csv,.txt,.xlsx">

        <!-- Manually Enter Emails -->
        <label class="block text-sm font-medium text-gray-700">Enter Emails (Comma Separated)</label>
        <textarea name="manual_emails" class="w-full border rounded p-2 mt-1 mb-4" rows="3" placeholder="example1@gmail.com, example2@gmail.com"></textarea>

        <!-- Reply-To Email -->
        <label class="block text-sm font-medium text-gray-700">Reply-To Email</label>
        <input type="email" name="reply_to" class="w-full border rounded p-2 mt-1 mb-4" placeholder="your-email@example.com">

        <!-- Email Subject -->
        <label class="block text-sm font-medium text-gray-700">Subject</label>
        <input type="text" name="subject" class="w-full border rounded p-2 mt-1 mb-4" placeholder="Email Subject">

        <!-- Message Body -->
        <label class="block text-sm font-medium text-gray-700">Message</label>
        <textarea name="message" class="w-full border rounded p-2 mt-1 mb-4" rows="5" placeholder="Type your message here..."></textarea>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Send Emails
        </button>
    </form>
</div>
@endsection
