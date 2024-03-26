@extends('admin.layout.app')
@section('_content')
    <div class="content-wrapper " >
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Site Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Site Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div id="successMessage" class="alert alert-success">
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
        @endif
        <section class="content">
            <div class="container-fluid">
                <?php $routeName='settings' ?>
                <form action="{{ isset($model) ? route($routeName.'.update',$model->id) :  route($routeName.'.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($model)
                        @method('PUT')
                    @endisset

                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                @foreach(config('app.languages') as $lang)
                                    <li class="nav-item ">
                                        <a class="nav-link {{$loop->first ? 'active show' : ''}}@error("$lang.title") text-danger @enderror" id="custom-tabs-one-home-tab" data-toggle="pill" href="#tab-{{$lang}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                @foreach(config('app.languages') as $lang)
                                    <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$lang}}" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="form-group">
                                            <label>Site Name</label>
                                            <input type="text" placeholder="Name" name="{{$lang}}[name]" value="{{ old($lang.'name', isset($model) ? $model->translateOrDefault($lang)->name : '') }}" class="form-control">
                                            @error("$lang.name")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" placeholder="Description" name="{{$lang}}[text]" value="{{old($lang.'text', isset($model) ? $model->translateOrDefault($lang)->text : ''  )}}" class="form-control">
                                            @error("$lang.text")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" placeholder="Title" name="{{$lang}}[title]" value="{{old($lang.'title', isset($model) ? $model->translateOrDefault($lang)->seo_title : ''  )}}" class="form-control">
                                            @error("$lang.title")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Seo Keywords</label>
                                            <input type="text" placeholder="Seo Keywords" name="{{$lang}}[seo_key]" value="{{old($lang.'seo_key', isset($model) ? $model->translateOrDefault($lang)->seo_key : ''  )}}" class="form-control">
                                            @error("$lang.seo_key")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Logo</label>
                                @isset($model->logo)
                                    <br>
                                    <img width="200" height="100" src="{{ asset('storage/'.$model->logo) }}">
                                @endisset
                                <input type="file" name="logo" class="form-control">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Favicon</label>
                                @isset($model->favicon)
                                    <br>
                                    <img width="200" height="100" src="{{ asset('storage/'.$model->favicon) }}">
                                @endisset
                                <input type="file" name="favicon" class="form-control">
                                @error('favicon')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>





                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </section>
    </div>



@endsection
