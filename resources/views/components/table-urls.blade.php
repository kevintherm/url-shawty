<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Original
                </th>
                <th scope="col" class="px-6 py-3">
                    Link
                </th>
                <th scope="col" class="px-6 py-3">
                    Clicks
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($urls as $url)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $url->uid }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $url->original }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ url($url->uid) }}" target="_blank"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ url($url->uid) }}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $url->clicks }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $url->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('url.inspector', $url->uid) }}"
                            class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">View</a>
                        <form method="POST" action="{{ route('url.destroy', $url->uid) }}">
                            @csrf
                            @method('delete')
                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        You have no shorten urls.
                    </th>

                </tr>
            @endforelse
        </tbody>
    </table>

</div>
