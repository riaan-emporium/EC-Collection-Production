@extends('layouts.app')
@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>

    <div class="page-content-wrapper m-t" style="padding-bottom:50px;">	
		<div class="row">
			<div class="col-sm-3">	
				<div class="row">
					<div class="col-sm-12">
						<a href="{{ URL::to('imapper') }}" class="files label"><span>Files</span></a>
						<?php foreach ($tree as $r) {
							echo $r;
						} ?>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						@if($fid>0)
							<h2 class="folder">
								<span id="folder_name">@if(!empty($foldername)){{$foldername->name}}@endif</span>
								<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>&nbsp;&nbsp;
							</h2>
						@else
							<h2 class="folder">
								<span id="folder_name">Files</span>
								<em> &bull; {{$subfoldertotal}} folders</em>
							</h2>
						@endif
						
						<div class="clear"></div>
					@if(!empty($rowData))
						@foreach($rowData as $row)
							@if($row['ftype']=='folder')
							<div class="gallery-box">
								<div class="caption folder"><a href="{{ URL::to('ifolders/').'/'.$row['id'] }}">{{strlen($row['name']) > 10 ? substr($row['name'],0,10)."~" : $row['name']}}</a></div>
								<div class="thumb big folder"><a href="{{ URL::to('ifolders/').'/'.$row['id'] }}">&nbsp;</a></div>
								<div class="info">
									<div>{{$row['filecount']}} files</div>
								</div>
							</div>
							@else
							<div class="gallery-box">
								<?php $expFile = explode('.',$row['name']); 
								$imgclass = $expFile[1];
								$isImg = 0;
								if($expFile[1]=="jpg" || $expFile[1]=="png" || $expFile[1]=="gif" || $expFile[1]=="bmp" || $expFile[1]=="jpeg" || $expFile[1]=="JPG") { 
								$imgclass = "img"; $isImg=1;
								} ?>
								
								<div class="caption {{$imgclass}}">
									<a href="{{ URL::to('ifiles/view/').'/'.$fid.'/'.$row['id'] }}" title="{{$row['name']}}">{{strlen($row['name']) > 10 ? substr($row['name'],0,7)."~.".$expFile[1] : $row['name']}}</a>
								</div>
								
								<div class="thumb {{$imgclass}}" <?php if($isImg==1) { ?> style="background: url('{{URL::to('uploads/thumbs/').'/thumb_'.$row['name']}}') no-repeat  center center; background-size:100px auto;" <?php } ?>>
									<a href="{{ URL::to('ifiles/view/').'/'.$fid.'/'.$row['id'] }}" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/medium_'.$row['name']}}" title="{{$row['name']}}" data-fancybox-group="button">
										&nbsp;
									</a>
								</div>
								<div class="info">
									
								</div>
							</div>
							@endif
						@endforeach
					@endif	
					</div>
				</div>
			</div>
		</div>
    </div>

	<script>
		$(function(){
			var fid = '<?php echo $fid; ?>';
			$('.parent'+fid).parents().show();
			$('.parent'+fid).show();
			
			$('input[type="checkbox"][id="check_all"]').on('ifChecked', function(){
				$('input[type="checkbox"].ff').iCheck('check');
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifUnchecked', function(){
				$('input[type="checkbox"].ff').iCheck('uncheck');
			});
		}); 
	</script>
@stop