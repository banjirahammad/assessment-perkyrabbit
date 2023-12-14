<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 ">
                    <form class="row align-items-center" method="POST" action="{{ route('department.update', $department->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Enter department name" value="{{ old('name', $department->name) }}" class="form-control" id="name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6 align-items-center">
                                <button type="submit" class="btn btn-primary text-primary text-light bg-primary" >Update Department</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
