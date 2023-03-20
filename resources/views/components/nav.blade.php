<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="https://flowbite.com" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Askmeanything</span>
        </a>
        <div class="flex items-center space-x-3">
            @if (Route::has('login'))
              @auth
                @if (Auth::check() && Auth::user()->is_employee)
                    <a href="{{ route('employee.index') }}" class="{{ request()->is('employee*', 'create') ? 'active' : '' }} text-lg font-medium leading-6 text-gray-900">Enquete</a>
                    <span>●</span>
                    <a href="{{ route('employee.question.index') }}" class="{{ request()->is('employee*', 'create') ? 'active' : '' }} text-lg font-medium leading-6 text-gray-900">Questions</a>
                    <span>●</span> 
                    <a href="{{ route('employee.index') }}" class="{{ request()->is('employee*', 'create') ? 'active' : '' }} text-lg font-medium leading-6 text-gray-900">Klanten profiles</a>
                    <span>●</span>
                @endif


                <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button class="text-lg font-medium leading-6 text-gray-900" type="submit">Logout</button>
                </form>
                @else
                  <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-lg font-medium leading-6 text-gray-900">Login</a>
                    <span>/</span>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-lg font-medium leading-6 text-gray-900">Register</a>
                  </div>
                @endif
              @endauth
            @endif
        </div>
    </div>
</nav>
