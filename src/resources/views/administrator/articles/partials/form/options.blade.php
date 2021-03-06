<div class="row">
    <div class="col-sm-3">
        <div class="form-group {{ $errors->has('parameters[show_title]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[show_title]">
                {{trans('cms::article.form.field.parameters.show_title')}}
                @tooltip('cms::article.form.tooltip.parameters.show_title')
            </label>
            {!! form()->select('parameters[show_title]', ['No', 'Yes'], $article->param('show_title', 1), ['id'=>'parameters[show_title]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[show_title]', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('parameters[show_author]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[show_author]">
                {{trans('cms::article.form.field.parameters.show_author')}}
                @tooltip('cms::article.form.tooltip.parameters.show_author')
            </label>
            {!! form()->select('parameters[show_author]', ['No', 'Yes'], $article->param('show_author', 1), ['id'=>'parameters[show_author]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[show_author]', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('parameters[show_create_date]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[show_create_date]">
                {{trans('cms::article.form.field.parameters.show_create_date')}}
                @tooltip('cms::article.form.tooltip.parameters.show_create_date')
            </label>
            {!! form()->select('parameters[show_create_date]', ['No', 'Yes'], $article->param('show_create_date', 1), ['id'=>'parameters[show_create_date]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[show_create_date]', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('parameters[show_modify_date]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[show_modify_date]">
                {{trans('cms::article.form.field.parameters.show_modify_date')}}
                @tooltip('cms::article.form.tooltip.parameters.show_modify_date')
            </label>
            {!! form()->select('parameters[show_modify_date]', ['No', 'Yes'], $article->param('show_modify_date', 1), ['id'=>'parameters[show_modify_date]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[show_modify_date]', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('parameters[show_hits]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[show_hits]">
                {{trans('cms::article.form.field.parameters.show_hits')}}
                @tooltip('cms::article.form.tooltip.parameters.show_hits')
            </label>
            {!! form()->select('parameters[show_hits]', ['No', 'Yes'], $article->param('show_hits', 1), ['id'=>'parameters[show_hits]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[show_hits]', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
