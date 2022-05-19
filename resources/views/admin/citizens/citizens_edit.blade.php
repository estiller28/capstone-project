<x-app-layout>
    <x-slot name="header">
        <h2 class=" text-xl text-gray-800 leading-tight">
            All Citizen / Update
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><strong>Update Citizen Information</strong> </div>
                        <div class="card-body">
                            <form action="{{ url('citizen/update/'. $citizens->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="citizen" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="citizen" name="first_name" value="{{ $citizens->first_name}}">

                                    @error('first_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror

                                    <label for="citizen" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="category" name="middle_name" value="{{ $citizens->middle_name}}">

                                    @error('middle_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror

                                    <label for="citizen" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="category" name="last_name" value="{{ $citizens->last_name}}">

                                    @error('last_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror <br>

                                    <label for="citizen" class="form-label">Purok</label>
                                    <select class="form-select" name="purok">
                                        @if($puroks->isEmpty())
                                           <option disabled> No Data </option>
                                        @endif
                                        @foreach($puroks as $purok)
                                            <option value="{{$purok->id}}" {{$citizens->purok_id == $purok->id ? 'selected' : ''  }}>{{$purok->purok_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Citizen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
