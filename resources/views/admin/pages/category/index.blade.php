@extends('admin.layout.app')
@section('_content')



    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                <h2 class="mr-3">KATEQORYA TABLE</h2>
                <button type="button" class="btn btn-success" onclick="window.location.href = '{{ route('category.create') }}'">ADD</button>
                </div>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>


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
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                                <thead>
                                <tr>

                                    <th>ID</th>

                                    <th>Ad</th>
                                    <th>Slug</th>
                                    <th class="text-center">Üst Kateqorya</th>
                                    <th class="text-center">Text</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Featured status</th>
                                    <th class="text-center">Sıra</th>
                                    <th class="text-center">Əməliyatlar</th>
                                    <th class="text-center">Yaradılma tarixi</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($models as $model)
                                <tr>
                                    <td>
                                    {{$model->id}}
                                    </td>
                                    <td>
                                        {{ strlen($model->name) > 20 ? substr($model->name, 0, 20) . '...' : $model->name }}</td>
                                    <td>
                                        {{ strlen($model->slug) > 20 ? substr($model->slug, 0, 20) . '...' : $model->slug }}</td>
                                    <td class="text-center">
                                        @if($model->parent)
                                            {{ strlen($model->parent->name) > 30 ? substr($model->parent->name, 0, 30) . '...' : $model->parent->name}}

                                        @else
                                        @endif
                                    </td>
                                    <td>{{ strlen($model->desc) > 30 ? substr($model->desc, 0, 30) . '...' : $model->desc }}</td>


                                    <td class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitches{{$model->id}}" {{ $model->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $model->id }})">
                                            <label class="custom-control-label" for="customSwitches{{$model->id}}"></label>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="dustomSwitches{{$model->id}}" {{$model->f_status == 1 ? 'checked' : ''}} onchange="updatefStatus({{$model->id}})">
                                            <label class="custom-control-label" for="dustomSwitches{{$model->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">{{$model->order}}</td>
                                    <td class=" d-flex justify-content-center">
                                        <form method="POST" action="{{route('category.edit',$model->id)}}">
                                            @csrf
                                            <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('category.edit',$model->id) }}'"><i class="fa fa-edit"> EDIT</i></button>
                                        </form>


                                        <form id="deleteForm{{$model->id}}" method="POST" action="{{ route('category.destroy', ['category' => $model->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmAndSubmit({{$model->id}})">
                                                <i class="fa fa-trash"></i> DELETE
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        {{ $model->created_at->format('d.m.Y') }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">{{$models->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">TESDİQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Silmək istədiyinizə misiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">XEYR</button>
                <button type="button" class="btn btn-danger" onclick="submitForm()">SİL</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmAndSubmit(id) {

        $('#confirmationModal').modal('show');
        window.submitForm = function() {
            $('#deleteForm'+id).submit();
        };
    }
    function updateStatus(id) {
        var status = document.getElementById('customSwitches' + id).checked ? 1 : 0;
        $.ajax({
            url: 'category/update-status/' + id,
            type: 'PUT',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
        });
    }
    function updatefStatus(id) {
        var f_status = document.getElementById('dustomSwitches' + id).checked ? 1 : 0;
        $.ajax({
            url: 'category/update-fstatus/' + id,
            type: 'PUT',
            data: {
                f_status: f_status,
                _token: '{{ csrf_token() }}'
            },
        });
    }
</script>
@endsection
