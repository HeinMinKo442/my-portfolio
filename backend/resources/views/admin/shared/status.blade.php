@if (session('status'))
    <div class="rounded border border-green-200 bg-green-50 p-4 text-sm text-green-700">
        {{ session('status') }}
    </div>
@endif
