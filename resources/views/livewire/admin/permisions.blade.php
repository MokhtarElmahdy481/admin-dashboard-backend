<div>
    <div class="">
        <x-sidebar />
        <div class="px-4 sm:ms-64">
            <x-navbar />
            @if (session('error'))
                <x-alert :message="session('error')" />
            @endif
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">

                    <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-900">

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
                                        {{trans('messages.role')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{trans('messages.permissions')}}
                                    </th>
                                    @foreach ($permissions as $permission)
                                        <th scope="col" class="px-6 py-3">
                                            {{ $permission->title }}
                                        </th>
                                    @endforeach
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
                                            {{ $role->title }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            @foreach ($role->permisions as $permision)
                                                <span>{{ $permision->title }}</span>
                                            @endforeach
                                        </th>
                                        @foreach ($permissions as $permission)
                                            <?php $flage = true; ?>
                                            <td class="px-6 py-4">
                                                @foreach ($role->permisions as $permision)
                                                    @if ($permision->title == $permission->title)
                                                        <input disabled type="checkbox" value="{{ $permision->title }}"
                                                            checked />
                                                        <?php $flage = false; ?>
                                                    @endif
                                                @endforeach
                                                @if ($flage)
                                                    <input disabled type="checkbox" value="{{ $permission->title }}" />
                                                @endif
                                            </td>
                                        @endforeach
                                        <th scope="row"
                                            class="flex gap-2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="">
                                                <select wire:model.live='selectedToAdd' class="w-full rounded">
                                                    <option value="{{ null }}" selected> select Permission
                                                    </option>
                                                    @foreach ($permissions as $permission)
                                                        <?php $flage2 = true; ?>
                                                        @foreach ($role->permisions as $permision)
                                                            @if ($permision->title == $permission->title)
                                                                <?php $flage2 = false; ?>
                                                            @endif
                                                        @endforeach
                                                        @if ($flage2)
                                                            <option value="{{ $permission->id }}">
                                                                {{ $permission->title }}

                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="">
                                                    <button wire:click="addPermission({{ $role->id }})" class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        {{trans('messages.add')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="">
                                                <select wire:model.live='selectedToRemove' class="w-full rounded">
                                                    <option value="{{ null }}" selected> select Permission
                                                    </option>
                                                    @foreach ($role->permisions as $permision)
                                                        <option value="{{ $permision->id }}">{{ $permision->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="">
                                                    <button wire:click="remove({{ $role->id }})" class="w-full focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                        {{trans('messages.delete')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>

                                @empty
                                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                        <th colspan="6" scope="row"
                                            class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            No Roles Found
                                        </th>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
