<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
           <div>
               <a href="{{ route('employee.create') }}" class="btn btn-primary">Add Employee</a>
           </div>
            <div class="bg-white p-4">
                <form class="row align-items-center" action="{{ route('employee.filter') }}" method="GET">
                    <div class="col-3">
                        <select
                            name="department"
                            class="form-select"
                             id="department"
                        >
                            <option value="" selected>Select department...</option>
                                                    @foreach($departments as $item)
                                                        <option
                                                            {{ request()->query('department') == $item->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}"
                                                        >{{ $item->name }}</option>
                                                    @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            placeholder="Search by name..."
                            value="{{ request()->query('name') }}"
                        >
                    </div>

                    <div class="col-2">
                        <input
                            class="form-control"
                            type="text"
                            name="email"
                            placeholder="Search by email..."
                            value="{{ request()->query('email') }}"
                        >
                    </div>
                    <div class="col-2">
                        <input
                            class="form-control"
                            type="text"
                            name="phone"
                            placeholder="Search by phone..."
                            value="{{ request()->query('phone') }}"
                        >
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-sm bg-primary">Search</button>
                        <a href="{{ url()->current() }}"
                           class="btn btn-sm btn-warning">
                            Clear filter
                        </a>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Department</th>
                                <th scope="col">Achievement</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $key => $item)
                            <tr>
                                <td>{{ $key + $employees->firstItem() }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address}}</td>
                                <td>{{ $item->department->name }}</td>
                                <td>
                                    @foreach($item->achievements as $arc)
                                    <li>{{ $arc->name }}</li>
                                    @endforeach

                                </td>
                                <td>
                                    <a href="{{ route('employee.edit',$item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <button data-delete-route="{{ route('employee.destroy', $item->id) }}"
                                            class="btn btn-sm btn-danger mt-1 delete-item-btn"
                                    >Delete</button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                new SlimSelect({
                    select: '#department'
                })

                $('.delete-item-btn').on('click', function(e) {
                    e.preventDefault();

                    const deleteRoute = $(this).data('delete-route');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action can not be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#d33',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Deleting item...',
                                text: 'Please wait while we are deleting the item!',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                url: deleteRoute,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Deleted successfully!',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error processing!',
                                        text: 'Please try again!',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endpush



</x-app-layout>
