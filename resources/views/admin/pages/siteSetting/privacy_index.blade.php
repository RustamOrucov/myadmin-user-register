@extends('admin.layout.app')
@section('_content')
    <div class="content-wrapper " >
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Privacy policy</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Privacy policy</li>
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
                <?php $routeName='privacy' ?>
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
                                            <label for="exampleFormControlTextarea1">Privacy policy</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="{{$lang}}[text]" rows="6">
        {{ old($lang.'name', isset($model) ? $model->translateOrDefault($lang)->text : '') }}
                                            </textarea>
                                        </div>

                                        @error("$lang.text")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-success m-3">Save</button>
                </form>
            </div>
        </section>
    </div>


@endsection
