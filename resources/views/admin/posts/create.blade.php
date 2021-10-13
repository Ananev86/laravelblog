@extends('admin.layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Название posta</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid" @enderror id="title" placeholder="Введите post">
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>content</label>
                        <textarea name="content" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Категория</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $key=>$cat)
                            <option value="{{$key}}">{{$cat}}</option>
                                @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Тэги</label>
                        <select name='tags[]' class="select2" multiple="multiple" data-placeholder="теги" style="width: 100%;">
                            @foreach($tags as $key=>$cat)
                                <option value="{{$key}}">{{$cat}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">izobragenija</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name='thumbnail' type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file1</label>
                            </div>

                        </div>
                    </div>


                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
@endsection
