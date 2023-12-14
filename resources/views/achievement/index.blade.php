<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Achievement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <a href="{{ route('achievement.create') }}" class="btn btn-primary">Add Achievement</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($achievements as $key => $item)
                            <tr>
                                <td>{{ $key + $achievements->firstItem() }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('achievement.edit',$item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <button data-delete-route="{{ route('achievement.destroy', $item->id) }}"
                                            class="btn btn-sm btn-danger delete-item-btn"
                                    >Delete</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    {{ $achievements->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
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
