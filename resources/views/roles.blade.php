<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ auth()->user()->getRoleNames() }}
            {{-- {{ backpack_user()->getRoleNames() }} --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2 p-2">
                @role('admin')
                I'm an admin!
                @else
                I'm not an admin...
                @endrole
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2 p-2">
                @hasrole('admin')
                I'm an admin!
                @else
                I'm not an admin...
                @endhasrole
            </div>
            {{ App\Models\Role::all()->pluck('name') }}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2 p-2">
                @hasanyrole(App\Models\Role::all())
                I have one or more of these roles!
                @else
                I have none of these roles...
                @endhasanyrole
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2 p-2">
                {{-- @hasallroles(App\Models\Role::all()) --}}
                @hasallroles('admin|editor')
                    I have all of these roles!
                @else
                    I don't have all of these roles
                @endhasallroles
            </div>
        </div>
    </div>
</x-app-layout>
