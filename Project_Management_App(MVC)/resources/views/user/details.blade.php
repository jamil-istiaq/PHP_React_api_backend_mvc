@extends('layouts.app')

@section('body')
<form action="{{route('update',$s->id)}}" method="post">
  {{@csrf_field()}}
<div class="signup-wrapper">
    <div class="form-wrapper">  
        <input type="hidden" name="id" value="{{$s->id}}">
        
        <div class="row">
          <div class="col-5">
            <div class="input-style-1">
              <label>Name</label>
              <input type="text" name="name" placeholder="Name" value="{{$s->name}}">
              @error('name')
                <span>{{$message}}</span>
              @enderror
            </div>
          </div>
          <!-- end col -->
          <div class="col-5">
            <div class="input-style-1">
              <label>Email</label>
              <input type="email" name="email" placeholder="Email" value="{{$s->email}}">
              @error('email')
                <span>{{$message}}</span>
              @enderror
            </div>
          </div>
          <!-- end col -->
          {{-- <div class="col-5">
            <div class="input-style-1">
              <label>Password</label>
              <input type="password" name="password" placeholder="Password">
           </div>
          </div> --}}
          <!-- end col -->

          <div class="col-5">
            <div class="input-style-1">
              <label>Phone</label>
              <input type="text" name="phone" placeholder="Phone Number" value="{{$s->phone}}">
              @error('phone')
                <span>{{$message}}</span>
              @enderror
            </div>
          </div>
          <!-- end col -->

          <div class="col-5">
            <div class="input-style-1">
              <label>Address</label>
              <textarea name="address" placeholder="Address">{{$s->address}}</textarea>
              @error('address')
                <span>{{$message}}</span>
              @enderror
              </div>
          </div>
          <!-- end col -->

          <div class="select-style-1">
            <label>Choose Role</label>
            <div class="select-position">
              <select name="role">
                <option selected="" disabled="">Choose Role</option>
                    <option value="Admin" @if($s->positions=="Admin") selected @endif>Admin</option>
                    <option value="User" @if($s->positions=="User") selected @endif >User</option>
                    <option value="Lead" @if($s->positions=="Lead") selected @endif>Project Lead</option>
                    <option value="Head" @if($s->positions=="Head") selected @endif>Project Head</option>
              </select>
              @error('role')
                <span>{{$message}}</span>
              @enderror
            </div>
            </div>
          <!-- end col -->
          <div class="col-12">
            <div class="
                button-group
                d-flex
                justify-content-center
                flex-wrap
              ">
              <button class="main-btn primary-btn btn-hover w-80 text-center">
                Update
              </button>
              {{-- <a href="{{route('update',['id'=>$s->id])}}" class="btn-sm primary-btn btn-hover">Update</a> --}}
            </div>
          </div>
        </div>
        <!-- end row -->
     
       
      </div>
    </div>
  </form>
@endsection

