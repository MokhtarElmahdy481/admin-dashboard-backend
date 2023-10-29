<div class="container mx-auto min-h-screen flex justify-center items-center">
    <div class="w-full md:w-4/5 lg:w-2/5 shadow rounded-lg py-5 px-10">
        <h1 class="uppercase text-center text-xl font-bold text-indigo-950">{{trans('messages.login')}}</h1>
        @if ($loginWith == 'email')
            <form wire:submit.prevent='loginWithEmail()'>
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="email" wire:model.live='email' id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{trans('messages.email')}}</label>
            @error('email')
                <p class="text-red-500 text-sm"> {{$message}} </p>
            @enderror
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="password" wire:model.live='password' id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{trans('messages.password')}}</label>
                @error('password')
                <p class="text-red-500 text-sm"> {{$message}} </p>
            @enderror
            </div>
            <div class="grid md:grid-cols-1 md:gap-6">
        
            </div>
            <div class="flex justify-between">
            <p wire:click="toggleLoginWith('phone')" class="mb-3 text-sky-700 cursor-pointer">{{trans('messages.Login with Phone')}}</p>
            <a href="{{route("register")}}" class="mb-3 text-sky-700 cursor-pointer">{{trans('messages.Create New Account')}}</a>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{trans('messages.Submit')}}</button>
        </form>
        @else
            <form wire:submit.prevent='loginWithPhone()'>
                @csrf
                <div class="relative z-0 w-full mb-6 group">
                    <input type="tel" wire:model.live='phone' id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{trans('messages.phone')}} (123-456-7890)</label>
                    @error('phone')
                    <p class="text-red-500 text-sm"> {{$message}} </p>
                @enderror
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" wire:model.live='password' id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{trans('messages.password')}}</label>
                    @error('password')
                    <p class="text-red-500 text-sm"> {{$message}} </p>
                @enderror
                </div>
                <div class="flex justify-between">
                    <p wire:click="toggleLoginWith('email')" class="mb-3 text-sky-700 cursor-pointer">{{trans('messages.Login with Email')}}</p>
                    <a href="{{route("register")}}" class="mb-3 text-sky-700 cursor-pointer">{{trans('messages.Create New Account')}}</a>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{trans('messages.Submit')}}</button>
          </form>
        @endif
      
    </div>
    </div>
    