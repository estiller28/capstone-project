<x-app-layout>
    <x-slot name="header">
        <h2 class=" text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-5">
                <div class="card py-4 px-4">
                    <div class="card-header ">
                        <h4>Roles</h4>
                    </div>
                    <div>
                        <table id="citizen_table" class="table table-striped display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th class="table-primary" scope="col">ID
                                <th class="table-primary" scope="col">Role Name
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i= 1 ?>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$role->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-5">
                <div class="card">
                    <div class="card-header"><h5> <strong>Add Roles</strong></h5></div>
                    <div class="card-body">
                        <form action="{{route('roles.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category" class="form-label">Role Name</label>
                                <input type="text" class="form-control"  id="validationServer01"  name="name" >
                                @error('name')
                                <span class="text-danger"> {{ $message }}</span><br>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
