 <x-layout title="ideas"> 
    <form method="POST" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Edit your Idea</label>
            <div class="mt-2">
            <textarea id="description" name="description" rows="3" class="textarea w-full">{{$idea->description}}</textarea>
            <x-forms.error name="description" />
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-2">
            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <button type="submit"
                    form="delete-idea-form"
                    class="btn btn-neutral">
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