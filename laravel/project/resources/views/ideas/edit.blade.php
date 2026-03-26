 <x-layout title="ideas"> 
    <form method="POST" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Edit your Idea</label>
            <div class="mt-2">
            <textarea id="description" name="description" rows="3" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">{{$idea->description}}</textarea>
            <x-forms.error name="description" />
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-2">
            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Update
            </button>

            <button type="submit"
                    form="delete-idea-form"
                    class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Delete
            </button>
        </div>
    </form>

    {{-- delete form attribute in button above == form belows id to make it submit the "delete form" --}}
    <form id="delete-idea-form" method="POST" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('DELETE')
    </form>
    
</x-layout>