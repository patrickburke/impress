{!! Form::hidden('id', '@{{ tag.id }}') !!}

<div class="form-group">
    <label for="name" class="col-md-2 control-label">Name</label>

    <div class="col-md-5">
        {!! Form::text('name', null, [
            'class' => 'form-control',
            'v-model' => 'tag.name'
        ]) !!}
    </div>
</div>

<div class="form-group">
    <label for="slug" class="col-md-2 control-label">Slug</label>

    <div class="col-md-5">
        <div class="input-group">
            {!! Form::text('slug', null, [
                'class' => 'form-control',
                'v-model' => 'tag.slug',
                'v-bind:readonly' => 'autoSlug',
                'readonly'
            ]) !!}
            <label class="input-group-addon">
                <input type="checkbox" v-model="autoSlug" checked> Auto
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="color_id" class="col-md-2 control-label">Color</label>

    <div class="col-md-5">
        @foreach($colors as $color)
            <div class="radio-inline form-control-color" style="background-color: #{{ $color->hex }}" v-bind:class="{ 'selected': tag.color_id == {{ $color->id }} }"
            >
                @icon('ok')
                <label>
                    {!! Form::radio('color_id', $color->id, null, [
                        'v-model' => 'tag.color_id'
                    ]) !!} {{ $color->hex }}
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-md-5 col-md-offset-2">
        <div class="pull-left">
            <a href="javascript:void(0);" v-show="tag.id != ''" v-on:click="deleteTag = tag" data-toggle="modal" data-target="#delete-tag-form" class="btn btn-link">Delete</a>
        </div>
        <div class="pull-right">
            <button type="submit" class="btn btn-success">@icon('ok') Save</button>
        </div>
    </div>
</div>