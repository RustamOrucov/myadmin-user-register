@extends('admin.layout.app')
@section('_content')
    <div class="content-wrapper " >
    <div class="container">
        <h1>User @if(isset($model)) update @else add  @endif </h1>
        <hr>
        @if (session('success'))

            <div class="alert alert-info alert-dismissable">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    var successMessage = document.getElementById('successMessage');
                    if (successMessage) {
                        successMessage.remove();
                    }
                }, 5000);
            </script>
        @endif<?php $routeName='user' ?>

            <form class="form-horizontal" role="form" action="{{ isset($model) ? route($routeName.'.update',$model->id) :  route($routeName.'.store')}}" method="POST" enctype="multipart/form-data" >
        <div class="row">
            @isset($model)
                @method('PUT')
            @endisset
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    @if( @isset($model) && !is_null($model->img))
                        <img width="200" src="{{asset('storage/'.$model->img)}}">
                    @else
                    <img src="{{asset('projects/admin/images/profile.jpg')}}" width="300" height="300" alt="avatar">
                    @endif
                    <input type="file" class="form-control mt-2" name="img">
                    @error("img")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">


                <h3 class="text-center text-black-50">İstifadəçi məlumatları</h3>


                    @csrf
                <div class="form-group mt-3">
                    <label class="col-lg-3 text-center control-label">Role</label>
                    <div class="col-lg-8">

                            <select  class="form-control" name="role">
                                @foreach($roles as $role)
                                <option value="{{$role->name}}"  @if(isset($model)) {{ $model->roles->contains('name', $role->name) ? 'selected' : '' }}@endif>{{$role->name}}</option>
                                @endforeach

                            </select>

                    </div>
                        </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 text-center control-label">Ad:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" placeholder="John" value="{{ isset($model) ? $model->name : old('name') }}" name="name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 text-center control-label">Soyad:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" placeholder="Doe" value="{{ isset($model) ? $model->surname : old('surname') }}" name="surname">
                            @error("surname")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 text-center control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="email" placeholder="testuser@gmail.com" value="{{ isset($model) ? $model->email : old('email') }}"  name="email">
                            @error("email")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 text-center control-label">Mobil nömrə:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                <select id="user_time_zone" class="form-control" name="prefix">
                                    <option value="050" {{ old('prefix', isset($model) && $model->prefix == '050' ? 'selected' : '') }}>050</option>
                                    <option value="051" {{ old('prefix', isset($model) && $model->prefix == '051' ? 'selected' : '') }}>051</option>
                                    <option value="055" {{ old('prefix', isset($model) && $model->prefix == '055' ? 'selected' : '') }}>055</option>
                                    <option value="070" {{ old('prefix', isset($model) && $model->prefix == '070' ? 'selected' : '') }}>070</option>
                                    <option value="077" {{ old('prefix', isset($model) && $model->prefix == '077' ? 'selected' : '') }}>077</option>
                                    <option value="079" {{ old('prefix', isset($model) && $model->prefix == '079' ? 'selected' : '') }}>079</option>
                                </select>

                                <input  class="form-control" type="number" name="phone" value="{{ isset($model) ? $model->phone : old('phone') }}"   class="input-class">

                            </div>
                            @error("phone")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <label class="col-md-3 text-center control-label">Password:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password"  name="password">
                            @error("password")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <span class="text-danger">*</span>
                    </div>
                <div class="col-lg-8 mt-4 text-center mb-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitchess" name="status" {{ old('status', isset($model) && $model->status == 1 ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customSwitchess">STATUS</label>
                    </div>

                </div>
                    <div class="form-group mt-3">
                        <label class="col-md-3 text-center control-label"></label>
                        <div class="col-md-8 text-center mt-3">
                            <button class="btn btn-primary" >Yadda saxla</button>

                        </div>
                    </div>
                </div>

            </div>
                </form>
        </div>
    </div>
    </div>
@endsection
