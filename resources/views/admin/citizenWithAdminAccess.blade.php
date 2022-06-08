@extends('layouts.admin')



    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-label">
                        Login Credentials
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-4">
                    <label>Role:</label>
                    <select style="width: 100%;" name="roles" class="form-control role custom-select" id="roles"  required aria-describedby="validationServer03Feedback">
                        <option value="">Select User Type</option>
                        <option selected="selected" value="1">Admin</option>
                        <option  value="2">Citizen</option>

                    </select>
                </div>
                <input type="hidden" value="{{ $citizen->email }}">
                <div class="form-group mb-4">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" id="password"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                    <span cl    ass="text-danger error-text purok_name_error"></span>
                </div>
                <div class="form-group mb-4">
                    <label>Confirm Password:</label>
                    <input type="password" name="passwordConfirm" class="form-control" id="confirm"  required aria-describedby="validationServer03Feedback" autocomplete="on">
                    <span class="text-danger error-text purok_name_error"></span>
                </div>
                <div class="form-group mb-4 adminBtn">
                    <button class="btn btn-sm btn-primary">Save User Access</button>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6" id="adminDiv">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-label">
                        User Access Permissions
                    </div>
                </div>
            </div>
            <form class="needs-validation" novalidate  action="{{ url('citizen/edit/permission/' . $citizen->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @foreach($permissions as $permission)
                        <div class="form-check icheck-primary">
                            <input name="permission[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" id="{{ $permission->id }}"
                                   @if($user->hasPermissionTo($permission->id))   checked @endif  />
                            <label class="form-check-label" for="{{ $permission->id }}"> {{ $permission->name }}</label>
                        </div>
                    @endforeach
                    <div class="form-group mt-5 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Save User Access</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


