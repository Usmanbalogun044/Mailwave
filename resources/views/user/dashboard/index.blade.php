@extends('user.layouts.user')
@section('title', 'Dashboard')
@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <h2 class="text-2xl font-bold">Welcome to MailWave</h2>
    <p class="mt-2 text-gray-600">Manage your email campaigns easily.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div class="bg-blue-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Total Subscribers</h3>
            <p class="text-2xl">1,200</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Campaigns Sent</h3>
            <p class="text-2xl">45</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Emails Bounced</h3>
            <p class="text-2xl">12</p>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Emails Sent Over Time</h3>
            <canvas id="emailsChart"></canvas>
        </div>
        <div class="bg-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Success vs. Bounced Emails</h3>
            <canvas id="bouncedChart"></canvas>
        </div>
    </div>
    
    <!-- File Upload Section -->
    <div class="mt-6 p-4 bg-gray-100 rounded-md shadow-md">
        <h3 class="text-lg font-bold">Upload Email List</h3>
        <input type="file" class="mt-2 p-2 border rounded-md w-full">
        <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Upload</button>
    </div>
    
    <!-- Recent Campaigns -->
    <div class="mt-6 p-4 bg-gray-100 rounded-md shadow-md">
        <h3 class="text-lg font-bold">Recent Campaigns</h3>
        <table class="w-full mt-2 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Campaign Name</th>
                    <th class="border border-gray-300 p-2">Status</th>
                    <th class="border border-gray-300 p-2">Sent On</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2">Promo Blast</td>
                    <td class="border border-gray-300 p-2 text-green-500">Completed</td>
                    <td class="border border-gray-300 p-2">March 5, 2025</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">New Product Launch</td>
                    <td class="border border-gray-300 p-2 text-yellow-500">In Progress</td>
                    <td class="border border-gray-300 p-2">March 4, 2025</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('emailsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Emails Sent',
                data: [120, 190, 300, 500, 200, 300],
                borderColor: 'blue',
                borderWidth: 2,
                fill: false
            }]
        }
    });

    const ctx2 = document.getElementById('bouncedChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Successful', 'Bounced'],
            datasets: [{
                data: [88, 12],
                backgroundColor: ['green', 'red']
            }]
        }
    });
</script>
@endsection
