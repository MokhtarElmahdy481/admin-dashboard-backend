<div>
    <div class="">
        <x-sidebar />
        <div class="px-4 sm:ms-64">
            <x-navbar />
            @if (session("error"))
            <x-alert :message="session('error')" />
            @endif
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">

                    <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-900">

                            {{-- <x-create-role-modal /> --}}
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input wire:model.live='search' type="text" id="table-search-users"
                                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for users">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{trans('messages.title')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{trans('messages.permissions')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{trans('messages.action')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            @if ($this->editableId != $role->id)
                                            {{ $role->title }}
                                            @else
                                            <input type="text" wire:model.live='editVal'>
                                            @endif
                                        </th>
                                        <td class="px-6 py-4">
                                            @foreach ($role->permisions as $permision)
                                                <span class="bg-slate-400 text-white rounded-full mx-1 py-1 px-2"> {{$permision->title}} </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($this->editableId != $role->id)
                                            <div class="inline-flex rounded-md shadow-sm">
                                                <button wire:click="toggleEditable({{$role->id}})" aria-current="page"
                                                    class="focus:outline-none text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-s-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                                    {{trans('messages.edit')}}
                                                </button>

                                                <button wire:click="delete({{$role->id}})"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-e-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    {{trans('messages.delete')}}
                                                </button>
                                            </div>
                                            @else
                                                <div class="inline-flex rounded-md shadow-sm">
                                                    <button wire:click="update()" aria-current="page"
                                                        class="focus:outline-none text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-l-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                                        Save
                                                    </button>
    
                                                    <button wire:click="cancelEditable()"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-r-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                        Cancel
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                @empty
                                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                        <th colspan="3" scope="row"
                                            class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            No Roles Found
                                        </th>

                                    </tr>
                                @endforelse
                                    @if (! $this->open)
                                        <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                            <td colspan="3" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <button wire:click='toggleOpen()' type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    +
                                                    <span class="sr-only">Icon description</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif

                                @if ($this->open)
                                    <tr>
                                        <td>
                                            <input type="text" wire:model.live='title' placeholder="Title">
                                            @error("title")
                                                <span class="text-red-500 text-xs">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <button

                                                wire:click='store()'
                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-l-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Add +
                                            </button>
                                            <button
                                                wire:click='toggleOpen()'
                                                type="button"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-r-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Cancel
                                            </button>
                                            </div>
                                        </td>
                                    </tr>                                    
                                @endif
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $roles->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
