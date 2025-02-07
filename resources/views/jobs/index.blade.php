<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job" />
        @empty
            No jobs available
        @endforelse
    </div>

    {{-- Pagination Links --}}
    {{$jobs->links()}}
</x-layout>
