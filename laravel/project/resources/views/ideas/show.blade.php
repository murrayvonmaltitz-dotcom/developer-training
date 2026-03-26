 <x-layout title="ideas"> 
        <div class="card bg-neutral p-6 ">
            <div>
                {{ $idea->description }}
            </div>
            <div class="mt-6">
                <a href="/ideas/{{ $idea->id }}/edit" class="btn">
                    Edit
                </a>
            </div>
        </div>


</x-layout>