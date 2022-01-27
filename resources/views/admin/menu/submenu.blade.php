@foreach($menu->children()->orderBy('order', 'asc')->get() as $menuchildIndex => $menu_child) 
<li data-id="{{$menu_child->id}}" data-label="{{$menu_child->title}}" class="dd-item dd3-item" data-url="{{$menu_child->link}}" data-attr_class="{{$menu_child->attr_class}}" data-attr_id="{{$menu_child->attr_id}}">
	<div class="dd-handle dd3-handle">
        Drag
    </div>
    <div class="dd3-content">
        <span>{{$menu_child->title}}</span>
        <div class="item-edit">Edit</div>
    </div>
    <div class="item-settings d-none">
        <p>
            <label for="">Navigation Label<br>
                <input type="text" class="form-control" name="navigation_label" value="{{$menu_child->title}}">
            </label>
        </p>
        <p>
            <label for="">Navigation Url<br>
                <input type="text" class="form-control" name="navigation_url" value="{{$menu_child->link}}">
            </label>
        </p>
        <p>
            <label for="">Custom Class<br>
                <input type="text" class="form-control" name="attr_class" value="{{$menu_child->attr_class}}">
            </label>
        </p>
        <p>
            <label for="">Custom ID<br>
                <input type="text" class="form-control" name="attr_id" value="{{$menu_child->attr_id}}">
            </label>
        </p>
        <p>
            <a class="item-delete" href="javascript:;">Remove</a> |
            <a class="item-close" href="javascript:;">Close</a>
        </p>
    </div>

      @if($menu_child->children->count() != 0)
            <ol class="dd_list">
                @include('admin.menu.submenu', ['menu' => $menu_child])
            </ol>
      @endif
</li>
@endforeach