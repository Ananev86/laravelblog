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
                <a href="{{route('tags.create')}}">create</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>name</th>
                        <th>slug</th>
                        <th>edit</th>
                        <th>deleate</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(count($tags))
                        @foreach($tags as $item)

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->slug}}</td>
                                <td><a href="{{route('tags.edit',['tag'=>$item->id])}}" >edit</a></td>
                                <td><form action="{{route('tags.destroy',['tag'=>$item->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' onclick="return confirm('podtverdite')"></button>
                                    </form></td>
                            </tr>
                        @endforeach

                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{$tags->links()}}
                            </ul>
                        </div>
                    @else
                        Tegov пока нет
                    @endif

                    </tbody>
                </table>
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
