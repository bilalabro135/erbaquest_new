@extends('layouts.admin.app', ['title' => 'Edit ' . request('type') . ' menu'])

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">

@endsection
@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
        @error('menu')
        <div class="alert alert-danger">
            {{$message}}                                            
        </div>
        @enderror
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4" id="menusBack">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"><h1 class="h3 mb-0 text-gray-800">Edit {{request('type')}} menu <div class="spinner-border text-primary" style="border-width: 3px; display: none;" role="status">
                              <span class="sr-only">Loading...</span>
                            </div></h1>
                                <form action="{{route('menus.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" id="menu_type" name="menu_type" value="{{request('type')}}">                                    
                                    <input type="hidden" id="nestable-output" name="menu">
                                    <button type="submit" id="save_menu" class="btn btn-primary">Save Menu</button>
                                </form>
                        </div>
                        <div class="card-body px-5">
                            @if($menus->count() == 0)
                                <div class="alert alert-warning">No Links Found</div>
                            @endif
                            <div class="dd" id="nestable">
                                <ol class="dd-list">                                
                                    @foreach($menus as $menuIndex => $menu) 
                                        <li data-id="{{$menu->id}}" data-label="{{$menu->title}}" class="dd-item dd3-item" data-url="{{$menu->link}}" data-attr_class="{{$menu->attr_class}}" data-attr_id="{{$menu->attr_id}}">

                                            <div class="dd-handle dd3-handle">
                                                Drag
                                            </div>
                                            <div class="dd3-content">
                                                <span>{{$menu->title}}</span>
                                                <div class="item-edit">Edit</div>
                                            </div>
                                            <div class="item-settings d-none">
                                                <p>
                                                    <label for="">Navigation Label<br>
                                                        <input type="text"  class="form-control" name="navigation_label" value="{{$menu->title}}">
                                                    </label>
                                                </p>
                                                <p>
                                                    <label for="">Navigation Url<br>
                                                        <input type="text" class="form-control" name="navigation_url" value="{{$menu->link}}">
                                                    </label>
                                                </p>
                                                <p>
                                                    <label for="">Custom Class<br>
                                                        <input type="text" class="form-control" name="attr_class" value="{{$menu->attr_class}}">
                                                    </label>
                                                </p>
                                                <p>
                                                    <label for="">Custom ID<br>
                                                        <input type="text" class="form-control" name="attr_id" value="{{$menu->attr_id}}">
                                                    </label>
                                                </p>
                                                <p>
                                                    <a class="item-delete" href="javascript:;">Remove</a> |
                                                    <a class="item-close" href="javascript:;">Close</a>
                                                </p>
                                            </div>
                                              @if($menu->children->count() != 0)
                                                    <ol class="dd_list">
                                                        @include('admin.menu.submenu')
                                                    </ol>
                                              @endif
                                        </li>
                                    @endforeach
                                </ol>                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card shadow  widget-card mb-4" id="">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h3 class="h5 m-0">Add Custom Link</h3>
                        </div>
                        <div class="card-body ">
                            <div class="alert-danger  alert" id="custom_link_error" style="display: none;"></div>
                            <div class="form-group">
                                <label for="label">Label</label>
                                <input type="text" class="form-control" name="label" id="label">
                             </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url">
                             </div>
                            <div class="form-group">
                                <button onclick="addCustomLink()" class="btn btn-primary btn-block">Add</button>
                            </div>
                        </div>
                    </div>
                    @can('viewPages')
                    <div class="card  widget-card shadow mb-4" id="">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h3 class="h5 m-0">Pages</h3>
                        </div>
                        <div class="card-body ">
                        @foreach($pages as $page)
                            <div class="card widget-card mb-2">
                                <a href="#page{{$page->id}}" class="d-block card-header py-3 collapsed " data-toggle="collapse" role="button" aria-expanded="false" aria-controls="page{{$page->id}}">
                                    <h6 class="m-0 font-weight-bold text-primary">{{$page->name}}</h6>
                                </a>
                                <div class="collapse" id="page{{$page->id}}" style="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="text" readonly="" class="form-control title" name="link" value="{{$page->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="btn btn-info" onclick="addLink('{{$page->name}}', '{{$page->slug}}')">
                                                Add to Menu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endcan                

                    @can('viewBlogs')
                    <div class="card  widget-card shadow mb-4" id="">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h3 class="h5 m-0">Blogs</h3>
                        </div>
                        <div class="card-body ">
                        @foreach($blogs as $blog)
                            <div class="card widget-card mb-2">
                                <a href="#blog{{$blog->id}}" class="d-block card-header py-3 collapsed " data-toggle="collapse" role="button" aria-expanded="false" aria-controls="blog{{$blog->id}}">
                                    <h6 class="m-0 font-weight-bold text-primary">{{$blog->name}}</h6>
                                </a>
                                <div class="collapse" id="blog{{$blog->id}}" style="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="text" readonly="" class="form-control title" name="link" value="{{$blog->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="btn btn-info" onclick="addLink('{{$blog->name}}', '{{$blog->slug}}')">
                                                Add to Menu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endcan  

                    @can('viewCategories')
                    <div class="card  widget-card shadow mb-4" id="">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h3 class="h5 m-0">Categories</h3>
                        </div>
                        <div class="card-body ">
                        @foreach($categories as $category)
                            <div class="card widget-card mb-2">
                                <a href="#category{{$category->id}}" class="d-block card-header py-3 collapsed " data-toggle="collapse" role="button" aria-expanded="false" aria-controls="category{{$category->id}}">
                                    <h6 class="m-0 font-weight-bold text-primary">{{$category->name}}</h6>
                                </a>
                                <div class="collapse" id="category{{$category->id}}" style="">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="text" readonly="" class="form-control title" name="link" value="{{$category->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="btn btn-info" onclick="addLink('{{$category->name}}', '{{$category->slug}}')">
                                                Add to Menu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endcan  
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>    
    <script type="text/javascript" src="{{ asset('js/admin/menu.js') }}"></script>
@endsection




