<x-layout>
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Expense Subcategories</h4>
            <a href="{{ route('expense_subcategory.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Subcategory
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if($subcategories->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Category</th>
                                <th>Subcategory Name</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->category->category_name ?? '—' }}</td>
                                    <td>{{ $item->sub_category_name }}</td>
                                    <td>
                                        <a href="{{ route('expense_subcategory.edit', $item->id) }}" 
                                           class="btn btn-sm btn-warning me-1">
                                           <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('expense_subcategory.destroy', $item->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Delete this subcategory?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">No subcategories found. Add one to get started.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
