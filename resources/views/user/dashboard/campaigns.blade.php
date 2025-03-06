@extends('user.layouts.user')

@section('content')
<div class="container mx-auto p-4 sm:p-6">
    <h2 class="text-2xl font-semibold mb-4">Email Campaigns</h2>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-md">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Campaign Button -->
    <button id="openCampaignModal" class="bg-blue-500 text-white p-3 rounded-md w-full sm:w-auto">
        Create Campaign
    </button>

    <!-- Campaign Modal -->
    <div id="campaignModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md sm:w-1/2 md:w-1/3 relative">
            <!-- Close Button -->
            <button id="closeCampaignModal" class="absolute top-3 right-3 text-gray-600 text-xl">&times;</button>

            <h3 class="text-lg font-semibold mb-3">Create New Campaign</h3>
            
            <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Campaign Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded-md" placeholder="Enter campaign name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Subject</label>
                    <input type="text" name="subject" class="w-full p-2 border rounded-md" placeholder="Enter email subject" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Email List</label>
                    <input type="file" name="email_file" class="w-full p-2 border rounded-md">
                    <p class="text-gray-500 text-sm mt-1">Upload a CSV/XLSX file or enter emails below.</p>
                    <textarea name="emails" class="w-full p-2 border rounded-md mt-2" placeholder="Enter emails manually, separated by commas"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Email Content</label>
                    <textarea name="content" class="w-full p-2 border rounded-md" placeholder="Enter email body" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Template</label>
                    <select name="template" class="w-full p-2 border rounded-md">
                        <option value="default">Default Template</option>
                        <option value="custom">Custom Template</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Campaign Status</label>
                    <select name="status" class="w-full p-2 border rounded-md" required>
                        <option value="draft">Draft</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="sent">Sent</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Schedule Send Date</label>
                    <input type="datetime-local" name="scheduled_at" class="w-full p-2 border rounded-md">
                </div>
                <button type="submit" class="bg-blue-500 text-white p-3 rounded-md w-full">
                    Create Campaign
                </button>
            </form>
        </div>
    </div>

    <!-- Campaigns List -->
    <div class="bg-white p-4 rounded-lg shadow-md mt-4">
        <h3 class="text-lg font-semibold mb-2">Previous Campaigns</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Name</th>
                        <th class="border p-2 text-left">Subject</th>
                        <th class="border p-2 text-left">Status</th>
                        <th class="border p-2 text-left">Sent</th>
                        <th class="border p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                    <tr class="text-sm">
                        <td class="border p-2">{{ $campaign->name }}</td>
                        <td class="border p-2">{{ $campaign->subject }}</td>
                        <td class="border p-2">{{ ucfirst($campaign->status) }}</td>
                        <td class="border p-2">{{ $campaign->created_at->format('Y-m-d') }}</td>
                        <td class="border p-2">
                            <a href="{{ route('campaigns.show', $campaign->id) }}" class="text-blue-500">View</a> |
                            <a href="{{ route('campaigns.edit', $campaign->id) }}" class="text-green-500">Edit</a> |
                            <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    document.getElementById("openCampaignModal").addEventListener("click", function() {
        document.getElementById("campaignModal").classList.remove("hidden");
    });

    document.getElementById("closeCampaignModal").addEventListener("click", function() {
        document.getElementById("campaignModal").classList.add("hidden");
    });
</script>
@endsection
