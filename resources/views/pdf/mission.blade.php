<!DOCTYPE html>
<html>
<head>
    <title>Mission PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { font-size: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Mission: {{ $mission->goal }}</h1>
    <p><strong>Date:</strong> {{ $mission->mission_date }}</p>
    <p><strong>CEO Signature Date:</strong> {{ $mission->ceo_signature_date }}</p>
    <h3>Assigned People:</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mission->people as $person)
                <tr>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->department->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <div x-show="menu"
        class="absolute right-0 z-10 flex origin-top-right flex-col rounded-md bg-white shadow-xl ring-1 ring-gray-900/5 dark:bg-gray-800"
        @click="menu = false">
        <button
            class="flex items-center gap-3 px-4 py-2 hover:rounded-t-md hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100"
            :class="theme === 'light' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="lightMode()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                </path>
            </svg>
            Light
        </button>
        <button
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400"
            :class="theme === 'dark' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="darkMode()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                </path>
            </svg>
            Dark
        </button>
        <button
            class="flex items-center gap-3 px-4 py-2 hover:rounded-b-md hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400"
            :class="theme === undefined ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="systemMode()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25">
                </path>
            </svg>
            System
        </button>
    </div>
    
</body>
</html>