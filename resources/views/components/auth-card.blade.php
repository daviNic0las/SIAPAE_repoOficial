<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div style="margin: -5px">
        <a href="/">
            <x-application-logo class="h-logo-login"/>

            <h1 class="ml-8 display-1 text-xl">
                <strong class="dark:text-gray-300">Login SIAPAE</strong>
            </h1>
        </a>
    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>