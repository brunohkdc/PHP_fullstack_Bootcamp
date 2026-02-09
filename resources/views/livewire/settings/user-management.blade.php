<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading class="mb-6" size="xl" level="1">{{ __('User Management') }}</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                     <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <table class="min-w-full table-fixed">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th class="w-48 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="w-64 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="w-32 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="w-24 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                                    <th class="w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 truncate">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 truncate">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $user->role}}</td>
                                    @if (! $user->disabled)
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Yes</span>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">No</span>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-2">

                                            <button class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Edit User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>

                                            <button class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>

                                            <button class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50" title="Change Password">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                                </svg>
                                            </button>

                                            <button class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200" title="Disable User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
    </div>
</section>
