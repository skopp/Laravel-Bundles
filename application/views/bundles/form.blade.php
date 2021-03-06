<section id="add">

	@if ($action == 'edit')
		<h1>{{__('form.edit')}}</h1>
	@else
		<h1>{{__('form.add')}}</h1>
	@endif

	@if (count($errors->messages) > 0)
		<div class="alert alert-error">
			<p>{{__('form.error')}}</p>
			<ul>
			@foreach ($errors->all('<li>:message</li>') as $error)
				{{$error}}
			@endforeach
			</ul>
		</div>
		{{Form::open(null, 'POST', array('class' => 'error '.$action))}}
	@else
		{{Form::open(null, 'POST', array('class' => $action))}}
	@endif
		{{Form::token()}}


			<!--
			<div class="control-group">
				{{Form::label('normalSelect', __('form.provider'), array('class' => 'control-label'))}}
				<div class="controls">
					<select name="provider" id="normalSelect" disabled="disabled">
						<option value="github" selected="selected">GitHub</option>
					</select>
				</div>
			</div>
			-->

			@if ($action != 'edit')
			<div class="select-repo">
				<div class="row">
					<div class="span4">
						<label class="control-label" for="repo">Select a repo</label>
						<div class="controls relative">
							{{Form::select('repo', $repos, Form::value('repo', $bundle), array('id' => 'repo'))}}
							<span class="or">OR</span>
						</div>

					</div>
					<div class="span4">
						<label class="control-label" for="repo">Add it manually:</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">http://github.com/</span>
								{{Form::text('manual_repo', Form::value('manual_repo', $bundle), array('class' => 'span2', 'id' => 'manual_repo'))}}
							</div>
						</div>
					</div>
				</div>

				<div class="continue">
					<button id="submit-repo" class="loading btn btn-primary" data-loading-text="Processing..."><span id="ajax-loader">{{HTML::image('img/ui-anim_basic_16x16.gif', 'Loading...')}}</span>Continue</button>
				</div>

				<div class="alert alert-info info hide">
					<strong>{{__('form.note')}}</strong> {{__('form.note_txt')}}
				</div>
			</div>
			@endif

			<div class="bundle_extras">

				{{Form::hidden('location', Form::value('location', $bundle), array('class' => 'span5', 'required' => 'required'))}}

				<div class="control-group">
					<label class="control-label" for="uri">Name</label>
					<div class="controls">
						{{Form::text('uri', Form::value('uri', $bundle), array('class' => 'span5', 'required' => 'required'))}}
						<p class="help-block">The keyword used to install and register your bundle.</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="title">{{__('form.title')}}</label>
					<div class="controls">
						{{Form::text('title', Form::value('title', $bundle), array('class' => 'span5', 'required' => 'required'))}}
						<p class="help-block">The title displayed in the bundle list.</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="summary">{{__('form.summary')}}</label>
					<div class="controls">
						<textarea required="required" class="input-xlarge" id="summary" name="summary" rows="5">{{Form::value('summary', $bundle)}}</textarea>
						<p class="help-block">{{__('form.summary_txt')}}</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="description">{{__('form.description')}}</label>
					<div class="controls">
						<textarea required="required" class="input-xlarge" id="description" name="description" rows="8">{{Form::value('description', $bundle)}}</textarea>
						<p class="help-block">{{__('form.description_txt')}}</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="path">Install Path</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">bundles/</span>
							{{Form::text('path', Form::value('path', $bundle), array('class' => 'span5', 'id' => 'path'))}}
							<p class="help-block">The path where the bundle should be installed.</p>
						</div>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="title">{{__('form.website')}}</label>
					<div class="controls">
						{{Form::text('website', Form::value('website', $bundle), array('class' => 'span5'))}}
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="category_id">{{__('form.category')}}</label>
					<div class="controls">
						<?php $selected = Form::value('category_id', $bundle); ?>
						{{Form::select('category_id', $categories, $selected, array('id' => 'category_id', 'required' => 'required'))}}
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="tags">{{__('form.tags')}}</label>
					<div class="controls">
						<ul id="tags" class="tagit" name="tags[]"></ul>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="Dependencies">{{__('form.dependencies')}}</label>
					<div class="controls">
						<ul id="dependencies" class="tagit" name="dependencies[]"></ul>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="active">{{__('form.active')}}</label>
					<div class="controls">
						<?php $selected = Form::value('active', $bundle); ?>
						{{Form::select('active', array('y' => __('form.yes'), 'n' => __('form.no')), $selected, array('id' => 'active'))}}
					</div>
				</div>

				<div class="form-actions">
					{{Form::submit(__('form.save'))}}
					{{Form::reset('Reset')}}
				</div>
			</div>

	{{Form::close()}}
</section>

<script>
@if (isset($tags) AND is_array($tags))
	var initialTags = [
		@foreach ($tags as $tag)
		"{{$tag}}",
		@endforeach
	];
@else
	var initialTags = [];
@endif

@if (isset($dependencies) AND is_array($dependencies))
	var initialDependenciesTags = [
	@foreach ($dependencies as $item)
		"{{$item}}",
	@endforeach
	];
@else
	var initialDependenciesTags = [];
@endif
</script>