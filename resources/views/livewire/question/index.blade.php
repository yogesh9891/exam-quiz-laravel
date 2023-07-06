    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage questions &nbsp;
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 my-3 px-4 py-2 rounded smal-texxt text-white">Create New </button>
                
     </h2>
       <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        
                        <th class="px-4 py-2">Question</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2"><a  href="javascript::void(0)"class="text-primary" wire:click="show({{ $question->id }})"> {{ $question->number }}</a></td>
                        <td class="border px-4 py-2">{{ $question->title }}</td>
                        <td class="border px-4 py-2">

                            @if($confirming===$question->id)

                                    <button wire:click="delete({{ $question->id }})" class="bg-red-500 hover:bg-red-700 text-white px-4 rounded">Yes</button>
                                    &nbsp;
                                    <button wire:click="cancelDlt()"
                                        class="bg-success hover:bg-green-700 text-white px-4 rounded">No</button>
                                @else
                                    <button wire:click="edit({{ $question->id }})" class="bg-blue-500 fo hover:bg-blue-700 px-4 rounded text-white">Edit</button>

                                    <button wire:click="confirmDelete({{ $question->id }})"
                                        class="bg-red-500 hover:bg-red-700 text-white px-4 rounded">Delete</button>
                                @endif                            

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
