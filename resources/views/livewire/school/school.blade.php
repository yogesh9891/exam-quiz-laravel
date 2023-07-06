{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage User 
    </h2>
</x-slot> --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage School &nbsp;
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New School</button>
                
            </h2>
            @if($isOpen)
                @if($updateMode)
                    @include('livewire.school.edit')                
                @else
                    @include('livewire.school.create')
                @endif
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">School Id</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $user->school_id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">

                             @if($confirming===$user->id)

                                <button wire:click="delete({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded">Yes</button>
                                &nbsp;
                                <button wire:click="cancelDlt()"
                                    class="bg-success hover:bg-green-700 text-white px-4 rounded">No</button>


                            @else
                                <button wire:click="edit({{ $user->id }})" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white">Edit</button>

                                <button wire:click="confirmDelete({{ $user->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white px-4 rounded">Delete</button>
                            @endif 
                                <a href="{{ route('admin.teachers',$user->id) }}" class="bg-success hover:bg-green-700 text-white px-4 rounded"> Teachers </a>

                                <a href="{{ route('admin.students',$user->id) }}" class="bg-info hover:bg-green-700 text-white px-4 rounded"> Students </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>