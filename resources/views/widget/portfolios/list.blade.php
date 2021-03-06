
@if (session('success'))
<div class="alert alert-success alert-important" style="width: 100%" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<span class="fa fa-check-circle"></span>
	{{ session('success') }}
</div>
@endif
@if ($portfolios->count() == 0)
<h3 class="mor-h3-color">@lang('portfolios.list.no_item')</h3>
@endif
@php
	$i = 1;
	if(!isset($index))
		$index = 0;
@endphp

@foreach ($portfolios as $portfolio)

	@php
		$styleCondition = isset($_POST['styles']) && !empty( $_POST['styles'] ) ? $_POST['styles'] : array();

		if($portfolio->user_nickname){
			$portfolio_user_nickname = $portfolio->user_nickname;
		}else{
			$portfolio_user_nickname = str_limit($portfolio->user_name, 14);
		}

		$portfolio_user_photo_url = url('/images/user.png');
		if (strpos($portfolio->user_photo, 'http') !== false) {
	        $portfolio_user_photo_url = $portfolio->user_photo;
	    }else if(!empty($portfolio->user_photo)){
	    	$portfolio_user_photo_url = Storage::disk('s3')->url(ltrim($portfolio->user_photo, "/"));
		}

		$portfolio_user_photoThumbnailUrl = $portfolio_user_photo_url;
		if (strpos($portfolio->user_photo_thumbnail, 'http') !== false) {
	        $portfolio_user_photoThumbnailUrl = $portfolio->user_photo_thumbnail;
	    }else if (!empty($portfolio->user_photo_thumbnail)) {
	        $portfolio_user_photoThumbnailUrl = Storage::disk('s3')->url(ltrim($portfolio->user_photo_thumbnail, "/"));
	    }

	@endphp


<div>
<div class="col-md-4" data-id="{{$portfolio->id}}"  data-index="{{$i+$index}}" id="por-{{$portfolio->id}}">

	<div class=" background-fff relative margin-bottom20 ">
		<div class="l-p-list-style">
				{{ portfolioStyle($pivotStyles[$portfolio->id], $styleCondition) }}
		</div>
		<div class="portfolio-control">
			@can ('update', $portfolio)
				<a href="{{ route('portfolios.edit', ['id' => $portfolio->id]) }}" class="btn btn-info btn-sm edit-portfolio">
					<i class="fa fa-pencil"></i>
					</a>
			@endcan
			@can ('delete', $portfolio)
				<a href="{{ url('/portfolios/' . $portfolio->id) }}"
				class="btn btn-danger btn-sm delete-portfolio">
					<i class="fa fa-close"></i>
				</a>
			@endcan
		</div>
		<a data-original-title="{{$portfolio->title}}" title="{{$portfolio->title}}" data-toggle="tooltip" class="l-bg-cover moviesearch1-back relative"
		style="background-image: url('{{ $portfolio->thumb_path }}');height: 250px;"   href="{{ url('/portfolios/' . $portfolio->id) }}">

		</a>
		@if (strpos($portfolio->mime, 'video') !== false)
			<span class="button-blue">
			<img src="{{ asset('images/camera.png') }}" alt="Play video">
			</span>
		@else
			<span class="button-red">
			<img src="{{ asset('images/icon_movie.png') }}" alt="Show image">
			</span>
		@endif
		<div class="fontsize14 p-info">
			<p class="title">{{ str_limit($portfolio->title,14)}}</p>
			<p class="name">{{$portfolio_user_nickname}}</p>
		</div>

		<a href="{{ route('creators.show', ['id' => $portfolio->user->id]) }}">

			<img style="bottom: 109px;" class="avatar1-back absolute-right2020 border-all-fff" src="{{$portfolio_user_photoThumbnailUrl}}" onerror="this.src='/images/user.png'">

		</a>
	</div>

</div>
@php
	$i++;
@endphp


</div>
@endforeach
<div style="width: 100%">
{{ $portfolios->render() }}
</div>

<script type="text/javascript">
$(document).ready(function() {
	if ($('#portfolios-filter').length > 0) {
	$('#portfolios-filter').crluoPagenation({dest: '#portfolios-list'});
	}
	$('[data-toggle="tooltip"]').tooltip();   
});
</script>
