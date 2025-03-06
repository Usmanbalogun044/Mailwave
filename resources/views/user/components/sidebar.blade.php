<!-- Sidebar Component (resources/views/user/components/sidebar.blade.php) -->
<div class="w-64 bg-white shadow-md h-full hidden md:block">
    <div class="p-6 text-xl font-bold text-gray-700" style="color: var(--primary-color);">MailWave</div>
    <ul class="mt-6">
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('dashboard') }}" class="flex items-center"><i class="fas fa-home mr-2"></i> Dashboard</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('subscribe') }}" class="flex items-center"><i class="fas fa-user-plus mr-2"></i> Subscriptions</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('campaigns.index') }}" class="flex items-center"><i class="fas fa-envelope mr-2"></i> Campaigns</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('bulk-email') }}" class="flex items-center"><i class="fas fa-paper-plane mr-2"></i> Bulk Email</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('settings') }}" class="flex items-center"><i class="fas fa-cog mr-2"></i> Settings</a></li>
    </ul>
</div>