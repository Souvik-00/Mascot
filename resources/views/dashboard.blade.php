<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>This is your dashboard page.</h5>
            <p>You can now manage your Organisations and other modules from the sidebar.</p>
        </div>
    </div>
</x-layout>
