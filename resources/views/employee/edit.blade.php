<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form class="row g-3" method="POST" action="{{ route('employee.update', $employee->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Enter your name" value="{{ old('name', $employee->name) }}" class="form-control" id="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" placeholder="Enter your email" name="email" value="{{ old('email', $employee->email) }}" class="form-control" id="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter your phone number" name="phone" value="{{ old('phone', $employee->phone) }}" class="form-control" id="phone">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                            <select id="department" name="department_id" class="form-select" autocomplete="off" >
                                <option selected>Select Department...</option>
                                @foreach($departments as $item)
                                    <option {{ $item->id == old('department_id', $employee->department->id) ? 'selected' : '' }} value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror


                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', $employee->address ) }}" id="address" placeholder="1234 Main St">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Achievements</label>
                            <a href="" class="btn btn-sm btn-primary float-end" id="addMore">Add Achievement</a>
                            <div class=" row ach_block">
                                @foreach($employee->achievements as $arc)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <select name="achievement_name[]" class="form-select" autocomplete="off" >
                                            @foreach($achievements as $item)
                                                <option {{ $item->id == old('id', $arc->id) ? 'selected' : '' }} value="{{ $item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="achievement_date[]" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <span class="btn btn-danger removeAch" >Remove</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('achievement_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary text-primary text-light bg-primary" >Update Employee</button>
                        </div>
                    </form>
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

                $("#addMore").click(function (e){
                    e.preventDefault();
                    $(".ach_block").append(`
                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <select name="achievement_name[]" class="form-select" autocomplete="off" >
                                                @foreach($achievements as $item)
                    <option {{ $item->id == old('id') ? 'selected' : '' }} value="{{ $item->id }}"> {{ $item->name }}</option>
                                                @endforeach
                    </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="achievement_date[]" value="" >
                    </div>
                    <div class="col-md-2">
                        <span class="btn btn-danger removeAch" >Remove</span>
                    </div>
                </div>
`);
                });

            });
            $(document).on('click', '.removeAch',function (e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });



        </script>
    @endpush



</x-app-layout>
