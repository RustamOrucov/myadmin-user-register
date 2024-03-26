@extends('admin.layout.app')
@section('_content')

    <div class="content-wrapper " >
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Kateqorya  @if(isset($model)) update @else əlavə et  @endif</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">Kateqoryalar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?php $routeName='category' ?>
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
                                            <label>Name</label>
                                            <input type="text" placeholder="Name" name="{{$lang}}[name]" value="{{ old($lang.'name', isset($model) ? $model->translateOrDefault($lang)->name : '') }}" class="form-control">
                                            @error("$lang.name")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" placeholder="Description" name="{{$lang}}[desc]" value="{{old($lang.'desc', isset($model) ? $model->translateOrDefault($lang)->desc : ''  )}}" class="form-control">
                                            @error("$lang.desc")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Seo Title</label>
                                            <input type="text" placeholder="Seo Title" name="{{$lang}}[seo_title]" value="{{old($lang.'seo_title', isset($model) ? $model->translateOrDefault($lang)->seo_title : ''  )}}" class="form-control">
                                            @error("$lang.seo_desc")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Seo Description</label>
                                            <input type="text" placeholder="Seo Description" name="{{$lang}}[seo_desc]" value="{{old($lang.'seo_desc', isset($model) ? $model->translateOrDefault($lang)->seo_desc : ''  )}}" class="form-control">
                                            @error("$lang.seo_desc")
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
                    <div class="form-group p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" class="custom-control-input" id="customSwitches" name="status" {{ !isset($model) ? 'checked' : old('status', $model->status == 1 ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="customSwitches">STATUS</label>
                                </div>


                            </div>
                            <div class="col-md-2">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="f_status" value="0">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchess" name="f_status" {{ old('f_status', isset($model) && $model->f_status == 1 ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="customSwitchess">FEATURED STATUS</label>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <select class="form-control" id="exampleFormControlSelect1" name="parent_id">
                                    <option value="">Üst kategori</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($model) && $model->parent_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->translateOrDefault(config('app_locale'))->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-3">
                                <div class="form-outline form-inline">
                                    <input type="number" id="typeNumber" name="order" placeholder="1" min="0" value="{{old('order',isset($model) ? $model->order : '')}}" class="form-control w-25 " />
                                    <label class="form-check-label ml-2" for="typeNumber">Order</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Img</label>
                        @isset($model->img)
                            <br>
                            <img width="200" src="{{asset('storage/'.$model->img)}}">
                        @endisset
                        <input type="file" name="img" class="form-control">
                        @error('img')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </section>
    </div>



@endsection
