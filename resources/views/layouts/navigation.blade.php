<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{__('Task manager')}}</span>
        </a>

        <div class="flex items-center lg:order-2">
            @guest
            <x-primary-hyperlink-button :href="route('login')">
                {{ __('nav.login')  }}
            </x-primary-hyperlink-button>
            <x-primary-hyperlink-button class="ml-2" :href="route('register')">
                {{ __('nav.register')  }}
            </x-primary-hyperlink-button>
            @endguest

            @auth
            <x-primary-hyperlink-button :href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout')  }}
            </x-primary-hyperlink-button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
        </div>

        @auth
        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="/tasks" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('nav.tasks') }}</a>
                </li>
                <li>
                    <a href="/task_statuses" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('nav.statuses') }}</a>
                </li>
                <li>
                    <a href="/labels" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('nav.labels') }}</a>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
