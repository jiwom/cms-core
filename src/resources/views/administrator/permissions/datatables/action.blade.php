<div class="btn-group">
    <a href="{!! route('administrator.permissions.edit', $id) !!}"
       class="btn btn-default btn-xs"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.edit')}}"
       data-container="body"
    >
        <i class="fa fa-pencil"></i>
    </a>
    @if(! $system)
        <button data-remote="{!! route('administrator.permissions.destroy', $id) !!}"
            class="btn btn-default text-red btn-xs btn-delete"
            data-toggle="tooltip"
            data-title="{{trans('cms::button.delete')}}"
            data-container="body"
        >
            <i class="fa fa-trash-o"></i>
        </button>
    @endif
</div>
