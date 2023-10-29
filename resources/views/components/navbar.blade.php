<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <x-logo/>
        <x-dropdown-lang />
        
        
        <x-dropdown-user :image="Auth::user()->image" />
        
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            
        </div>
    </div>
</nav>
