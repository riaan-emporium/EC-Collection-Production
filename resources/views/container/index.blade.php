@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/dropzone.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
<script src="{{ asset('sximo/js/tooltip_popup.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}">
<script src="{{ asset('sximo/js/plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
<style>
.size-bar-side{overflow: hidden;}
div[data-load="left-side-tree"]{max-height: 600px;    overflow: auto;}
.leng { display:none; }
.btn_orange, .btn_orange:hover, .btn_orange:focus, .btn_orange:active, .btn_orange.active, .open .dropdown-toggle.btn_orange {  background-color: orange; border-color: orange; }
.disnon { display:none; }
.lightboxmodal { z-index:1060; }
</style>

<?php $imgfancy = array();
	$filType = array('jpg'=>'JPEG image', 'jpeg'=>'JPEG image', 'JPG'=>'JPEG image', 'png'=>'PNG image', 'gif'=>'GIF image', 'xls'=>'Excel spreadsheet', 'eps'=>'EPS Image', 'mp4'=>'MPEG-4 video', 'mkv'=>'Matroska Video', 'flv'=>'Flash Video', 'avi'=>'Audio Video', 'wma'=>'Windows Media Audio', 'wmp'=>'Windows Media Player', 'psd'=>'PSD Image', 'pdf'=>'PDF document', 'ppt'=>'PowerPoint presentation', 'mp3'=>'MP3 audio', 'tif'=>'TIFF image', 'doc'=>'Word document', 'docx'=>'Word document', 'bmp'=>'Bitmap image', 'cad'=>'CAD image', 'zip'=>'Compress document');
 ?>
  <div class="page-content row" style="margin-bottom: 85px;">
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
						<a href="{{ URL::to('container?show='.$showType) }}" class="files label"><span>Files</span></a>
						<div data-load="left-side-tree"><p style="padding-top: 20px;">Loading...</p></div>
						<?php /*foreach ($tree as $r) {
							echo $r;
						} */?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="size-bar-side">
							<div style="width: {{$usedStoragePerct}}%">&nbsp;</div>
						</div>
						<div class="size-txt-side">
							<em>{{$usedStorage}} MB</em> ({{$usedStoragePerct}}%) of <em> {{$allowStorage}} MB</em> used
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-success btn-lg" onclick="selectfolderfiles();" data-toggle="modal" data-target="#sendEmail">
							<span class="icn"><i class="icon-share"></i> {{\Lang::get('core.menu_share')}}</span>
						</button>
						<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#Directorypermission" @if($fid==0) disabled="disabled" @endif>
						  <span class="icn"><i class="icon-people"></i>{{\Lang::get('core.menu_permission')}}</span>
						</button>
						<button type="button" class="btn btn-primary btn-lg btn_orange" data-toggle="modal" data-target="#newDirectory">
							<span class="icn"><i class="icon-folder-plus"></i> {{\Lang::get('core.menu_new_folder')}}</span>
						</button>
						
						
						<!-- Operation button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-settings"></i> {{\Lang::get('core.menu_operations')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#copyFolderFile">{{\Lang::get('core.menu_copy_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#moveFolderFile">{{\Lang::get('core.menu_move_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#deleteFolderFile">{{\Lang::get('core.menu_delete_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignAttribute">{{\Lang::get('core.menu_assign_attribute_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignTags">{{\Lang::get('core.menu_assign_tag_folder_file')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignMainImage">{{\Lang::get('core.menu_assign_main_image')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('file_frontend');">{{\Lang::get('core.menu_frontend')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('unassign_file_frontend');">{{\Lang::get('core.menu_deactivate_frontend')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignDesigner">{{\Lang::get('core.menu_assign_designer')}}</a></li>
							<!--<li><a href="#" onclick="select_folderfilesfor_download('frontend_slider');" data-toggle="modal" data-target="#assignFrontendSlider">{{\Lang::get('core.menu_operation_frontend_slider')}}</a></li>-->
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Slider');">{{\Lang::get('core.menu_operation_slider_folder')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Produktvarianten');">{{\Lang::get('core.menu_operation_variant_folder')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'Jpg');">{{\Lang::get('core.menu_operation_jpg_folder')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('assign_categories_landing');">{{\Lang::get('core.menu_operation_assign_landing')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('activate_lightbox');">{{\Lang::get('core.menu_operation_activate_lightbox')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('deactivate_lightbox');">{{\Lang::get('core.menu_operation_deactivate_lightbox')}}</a></li>
							<li><a href="#" onclick="submit_folder_form('create_folders', 'JPG Highres');">{{\Lang::get('core.menu_operation_png_folder')}}</a></li>
							<li><a href="#" onclick="selectfolderfiles();" data-toggle="modal" data-target="#assignPdfImage">{{\Lang::get('core.menu_assign_pdf_image')}}</a></li>
						  </ul>
						</div>
						
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($fid==0) disabled="disabled" @endif><span class="icn"><i class="icon-upload3"></i> {{\Lang::get('core.menu_upload')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($fid==0) disabled="disabled" @endif>
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#newFile">{{\Lang::get('core.menu_upload')}}</a></li>
							<li><a href="#">{{\Lang::get('core.menu_upload_zip')}}</a></li>
						  </ul>
						</div>
						
						<!-- Download button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-folder-download"></i> {{\Lang::get('core.menu_download')}}</span></button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" onclick="select_folderfilesfor_download('file_download');">{{\Lang::get('core.menu_download_zip')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('lowpdf_download');">{{\Lang::get('core.menu_download_low_pdf')}}</a></li>
							<li><a href="#" onclick="select_folderfilesfor_download('highpdf_download');">{{\Lang::get('core.menu_download_high_pdf')}}</a></li>
							<li><a href="#" onclick="entire_folderfilesfor_download();">{{\Lang::get('core.menu_download_entire_folder')}}</a></li>
						  </ul>
						</div>
						
						<button type="button" class="btn btn-primary btn-lg btn_orange" onclick="add_to_lightbox();">
							<span class="icn"><i class="icon-share"></i> Add to Merkzettel</span>
						</button>
												
						@if($group!=3) 
						<!-- permission button -->
						
						@endif
						@if($group==1 && (!empty($foldername) && $foldername->parent_id==0)) 
						<!-- global permission button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{\Lang::get('core.menu_global')}}</button>
						  <button type="button" class="btn btn-primary btn-lg dropdown-toggle btn_orange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#globalDirectorypermission">{{\Lang::get('core.menu_global_set')}}</a></li>
							<li><a href="#" data-toggle="modal" data-target="#RemoveglobalDirectorypermission">{{\Lang::get('core.menu_global_remove')}}</a></li>
						  </ul>
						</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						@if($fid>0)
							<h2 class="folder">
								<span id="folder_name">
									<a href="{{ URL::to('container?show='.$showType) }}"><span>Files</span></a>
									@if(!empty($parentArr))
										@foreach($parentArr as $parArr)
											/ @if(end($parentArr)!=$parArr)<a href="{{ URL::to('folders/'.$parArr->id.'?show='.$showType) }}">{{$parArr->display_name}}</a>@else {{$parArr->display_name}} @endif
										@endforeach
									@endif
								</span>
								<em> &bull; {{$subfilestotal}} files &bull; {{$subfoldertotal}} folders &bull; {{$subfileSpace}} MB</em>&nbsp;&nbsp;
								<a href="#" data-toggle="modal" data-target="#editDirectory" class="foldout renamefolder" title="Edit this folder">
									<img src="{{URL::to('uploads/images/folder_edit.png')}}" alt="" width="16" height="16" title="" class="img-icon">
								</a>&nbsp;&nbsp;
								<a href="#" data-toggle="modal" data-target="#deleteFolder" class="foldout delete" title="Delete this folder">
									<img src="{{URL::to('uploads/images/folder_delete.png')}}" alt="" width="16" height="16" title="" class="img-icon">
								</a>
							</h2>
						@else
							<h2 class="folder">
								<span id="folder_name">Files</span>
								<em> &bull; {{$subfoldertotal}} folders</em>
							</h2>
						@endif
						
						@if($showType=="thumb")	
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'containersearch', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
										</div>
										<div class="col-sm-6" style="text-align:right; padding-right:0px;">
											<button type="submit" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
											</button>
											<a href="{{ URL::to('container?show='.$showType) }}" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-spinner8"></i> {{\Lang::get('core.menu_reset')}}</span>
											</a>
											<!-- View button -->
											<div class="btn-group">
											  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-screen2"></i> {{\Lang::get('core.menu_view')}}</span></button>
											  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											  </button>
											  <ul class="dropdown-menu">
												<li><a href="{{ Request::url().'?show=list'}}">{{\Lang::get('core.menu_view_list')}}</a></li>
												<li><a href="{{ Request::url().'?show=thumb'}}">{{\Lang::get('core.menu_view_gallery')}}</a></li>
												<li><a href="#" id="fancybox-manual-c">{{\Lang::get('core.menu_view_slideshow')}}</a></li>
												<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'high');">{{\Lang::get('core.menu_view_high_flipbook')}}</a></li>
												<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'low');">{{\Lang::get('core.menu_view_low_flipbook')}}</a></li>
											  </ul>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="clear"></div>
							@if(!empty($rowData))
								<div id="container_sortable">	
									@foreach($rowData as $row)
										@if($row['ftype']=='folder')
										<div class="gallery-box ui-state-default">
											<div class="caption folder">
												<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}">{{(strlen($row['name']) > 8) ? substr($row['name'],0,8)."~" : $row['name']}}</a>
												<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$row['name']}}" />
												@if($row['assign_front']=='yes')
													<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate Frontend" onclick="frontend_grid(this,'folder','{{$row['id']}}',1);" />
												@else
													<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate Frontend" onclick="frontend_grid(this,'folder','{{$row['id']}}',0);" />
												@endif
											</div>
											
											<?php $folderPic = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/thumb_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
											
												$folderPicPopup = ($row['cover_img']!='')? URL::to('uploads/folder_cover_imgs/format_'.$row['cover_img']): URL::to('uploads/images/folder_big.png');
												
												$img_name = ($row['cover_img']!='')? 'format_'.$row['cover_img']: 'folder_big.png';
											?>
											
											<div class="thumb folder" style="background: url('{{ $folderPic }}') no-repeat  center center; background-size:100px auto;" >
												<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}" rel="{{$folderPicPopup}}" rel2="{{$img_name}}" title="{{$row['name']}}" class="screenshot">&nbsp;</a>
											</div>
											<div class="info">
												<label><input type="checkbox" name="compont[]" id="compont" value="folder-{{$row['id']}}" class="no-border check-files ff"></label>
												<div>{{$row['foldercount']}} folder</div>
												<div>{{$row['filecount']}} file</div>
											</div>
										</div>
										@else
										<div class="gallery-box ui-state-default">
											<?php $expFile = explode('.',$row['name']); 
											$imgclass = end($expFile);
											$ext = end($expFile);
											$isImg = 0;
											if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp" || $ext=="jpeg" || $ext=="JPG") { 
												$imgclass = "img"; $isImg=1;
												$imgfancy[] = $row['imgsrc'].$row['name'];
											}
											$fname = ($row['file_display_name']!='')? $row['file_display_name']: $row['name'];
											?>
											
											<div class="caption {{$imgclass}}">
												<a class="lfile" href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 5 ? substr($fname,0,2)."~.".$ext : $fname}}</a>
												<img src="{{URL::to('uploads/images/information.png')}}" style="cursor:pointer;" class="screenshot" rel="{{($row['title']!='')?$row['title']:''}}" rel2="{{($row['description']!='')?$row['description']:''}}" title="{{$fname}}" />
												@if($row['assign_front']=='yes')
													<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate Frontend" onclick="frontend_grid(this,'file','{{$row['id']}}',1);" />
												@else
													<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate Frontend" onclick="frontend_grid(this,'file','{{$row['id']}}',0);" />
												@endif
												@if($row['assign_lightbox']=='yes')
													<img src="{{URL::to('uploads/images/activated_lightbox.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate Lightbox" onclick="lightbox_grid(this,'{{$row['id']}}',1);" />
												@else
													<img src="{{URL::to('uploads/images/not_activated_lightbox.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate Lightbox" onclick="lightbox_grid(this,'{{$row['id']}}',0);" />
												@endif
											</div>
											<?php if($ext=="pdf")
											{
												$imgclass = "bigpdf";
											}?>
											<div class="thumb cinner{{$imgclass}}" <?php if($isImg==1) { ?> style="background: url('{{URL::to('uploads/thumbs/').'/thumb_'.$fid.'_'.$row['name']}}') no-repeat  center center; background-size:100px auto;" <?php } ?>>
												<a href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$fid.'_'.$row['name']}}" title="{{$fname}}" rel2="{{$fname}}" data-fancybox-group="button">
													&nbsp;
												</a>
											</div>
											<div class="info">
												<label><input type="checkbox" value="file-{{$row['id']}}-{{$ext}}" name="compont[]" id="compont" class="no-border check-files ff"></label>
												@if(($row['tiff_files']!='') && !empty($row['tiff_files']))
													<div style="border-right:none;">
													@foreach($row['tiff_files'] as $tif)
														<?php $expTif = explode('.',$tif->file_name); 
														$imgval = $expTif[1]; ?>
														<a href="{{ URL::to('tfiles/view/').'/'.$fid.'/'.$tif->id.'?show='.$showType }}">&nbsp;&nbsp;{{strtoupper($imgval)}}&nbsp;&nbsp;</a>
													@endforeach
													</div>
												@endif
												<div class="action">
													<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
														<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
													</a>
												</div>
											</div>
										</div>
										@endif
									@endforeach
								</div>
							@endif
						@elseif($showType=="list")
							<div class="gallery-select-all">
								<label style="float:left;">
									<input type="checkbox" value="1" id="check_all" class="check-all"> Select all
								</label>
								<div class="row">
									{!! Form::open(array('url'=>'search', 'class'=>'columns' ,'id' =>'search', 'method'=>'get' )) !!}
										<input type="hidden" name="show" value="{{ $showType }}">
										<div class="col-sm-4">
											<input type="text" name="searchkeyword" value="" class="form-control" placeholder="Enter your keyword here" style="height:37px !important;" />
										</div>
										<div class="col-sm-6" style="text-align:right; padding-right:0px;">
											<button type="submit" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-search2"></i> {{\Lang::get('core.menu_search')}}</span>
											</button>
											<a href="{{ URL::to('container?show='.$showType) }}" class="btn btn-primary btn-lg">
												<span class="icn"><i class="icon-spinner8"></i> {{\Lang::get('core.menu_reset')}}</span>
											</a>
											<!-- View button -->
											<div class="btn-group">
											  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icn"><i class="icon-screen2"></i> {{\Lang::get('core.menu_view')}}</span></button>
											  <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											  </button>
											  <ul class="dropdown-menu">
												<li><a href="{{ Request::url().'?show=list'}}">{{\Lang::get('core.menu_view_list')}}</a></li>
												<li><a href="{{ Request::url().'?show=thumb'}}">{{\Lang::get('core.menu_view_gallery')}}</a></li>
												<li><a href="#" id="fancybox-manual-c">{{\Lang::get('core.menu_view_slideshow')}}</a></li>
												<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'high');">{{\Lang::get('core.menu_view_high_flipbook')}}</a></li>
												<li><a href="#" onclick="select_folderfilesfor_download('flipbook', 'low');">{{\Lang::get('core.menu_view_low_flipbook')}}</a></li>
											  </ul>
											</div>
										</div>
									</form>
								</div>
							</div>
							<table class="list js-dynamitable table table-bordered">
								<thead>
									<tr>
										<th class="check" width="5%">
											<label><input type="checkbox" value="1" id="check_all" class="check-all"></label>
										</th>
										<th width="25%">Name</th>
										<th width="5%"></th>
										<th width="5%"></th>
										<th width="20%">Title</th>
										<th width="20%">Description</th>
										<th width="15%">File Type</th>
										<th width="5%">Status</th>
									</tr>
									<tr>
										<th></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th></th>
										<th></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th><input type="text" class="js-filter  form-control" value="" /></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($rowData))
									{{--*/ $al=1 /*--}}
										@foreach($rowData as $row)
										{{--*/ $alt = ($al%2==0)? 'alt' : ''; /*--}}
											@if($row['ftype']=='folder')
												<tr class="{{$alt}}">
													<td class="check">
														<label><input type="checkbox" name="compont[]" id="compont" value="folder-{{$row['id']}}" class="no-border check-files ff"></label>
													</td>
													<td class="rowtitle folder">
														<a href="{{ URL::to('folders/').'/'.$row['id'].'?show='.$showType }}">{{strlen($row['name']) > 22 ? substr($row['name'],0,20)."~" : $row['name']}}</a>
													</td>
													<td></td>
													<td></td>
													<td>{{($row['title']!='')?$row['title']:''}}</td>
													<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
													<td>Folder</td>
													<td style="text-align:center;">@if($row['assign_front']=='yes')
															<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'folder','{{$row['id']}}',1);" />
														@else
															<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'folder','{{$row['id']}}',0);" />
														@endif
													</td>
												</tr>
											@else
												<?php $expFile = explode('.',$row['name']); 
												$imgclass = end($expFile);
												$ext = end($expFile);
												$isImg = 0;
												if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp" || $ext=="jpeg" || $ext=="JPG") {
													$imgclass = "img"; $isImg=1;
													$imgfancy[] = $row['imgsrc'].$row['name'];
												}
												$fname = ($row['file_display_name']!='')? $row['file_display_name']: $row['name'];
												?>
												<tr class="{{$alt}}">
													<td class="check">
														<label><input type="checkbox" value="file-{{$row['id']}}-{{$ext}}" name="compont[]" id="compont" class="no-border check-files ff"></label>
													</td>
													<td class="rowtitle {{$imgclass}}">
														<a href="{{ URL::to('files/view/').'/'.$fid.'/'.$row['id'].'?show='.$showType }}" title="{{$row['name']}}">{{strlen($fname) > 22 ? substr($fname,0,18)."~.".$ext : $fname}}</a>
													</td>
													<td style="text-align:center;">
														<a href="#" class="screenshot fancybox-buttons" rel="{{URL::to('uploads/thumbs/').'/format_'.$fid.'_'.$row['name']}}" title="{{$fname}}" data-fancybox-group="button">
															<img src="{{URL::to('uploads/images/magnifier.png')}}" width="16" height="16" alt="Preview">
														</a>
													</td>
													<td style="text-align:center;">
														<a href="{{$row['imgsrc'].$row['name']}}" title="Download" download="{{$row['name']}}">
															<img src="{{URL::to('uploads/images/bullet_download.png')}}" width="16" height="16" alt="Download">
														</a>
													</td>
													<td>{{($row['title']!='')?$row['title']:''}}</td>
													<td>{{($row['description']!='')?substr($row['description'],0,20):''}}</td>
													<td>{{$filType[$ext]}}</td>
													<td style="text-align:center;">@if($row['assign_front']=='yes')
															<img src="{{URL::to('uploads/images/activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Deactivate" onclick="frontend_grid(this,'file','{{$row['id']}}',1);" />
														@else
															<img src="{{URL::to('uploads/images/not_activated.png')}}" style="cursor:pointer; margin-left:5px;" title="Click to Activate" onclick="frontend_grid(this,'file','{{$row['id']}}',0);" />
														@endif
													</td>
												</tr>
											@endif
											{{--*/ $al++ /*--}}
										@endforeach
									@endif
								</tbody>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>
    </div>

	<!-- New Folder Modal -->
	<div class="modal fade" id="newDirectory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create new folder</h4>
		  </div>
		  {!! Form::open(array('url'=>'addfolder', 'class'=>'columns' ,'id' =>'folder_new', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Folder name <em>*</em> <small> ( Enter multiple values comma separated. Ex:- xxx,yyy )</small></label>
					<div class="field-input">
						<input name="folder" class="form-control" type="text" value="" required="required">
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Create Folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Edit Folder Modal -->
	<div class="modal fade" id="editDirectory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Edit this folder <span style="float:right; margin-right:10px;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></h4>
		  </div>
		  {!! Form::open(array('url'=>'editfolder', 'class'=>'columns' ,'id' =>'folder_edit', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Folder name <em>*</em></label>
					<div class="field-input">
						<input name="oldfolder" type="hidden" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name:'';?>">
						<input name="editfolder" class="form-control ldutch" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name:'';?>" required="required">
						
						<input name="editfolder_eng" class="form-control leng" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->display_name_eng:'';?>" >
					</div>
				</div>
				<div class="field">
					<label>Title <em>*</em></label>
					<div class="field-input">
						<input name="folder_title" class="form-control ldutch" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->title:'';?>" required="required">
						
						<input name="folder_title_eng" class="form-control leng" type="text" size="30" value="<?php echo ($fid>0 && !empty($foldername))? $foldername->title_eng:'';?>" >
					</div>
				</div>
				<div class="field">
					<label>Description <em>*</em></label>
					<div class="field-input">
						<textarea name="folder_desc" class="form-control ldutch" required="required"><?php echo ($fid>0 && !empty($foldername))? $foldername->description:'';?></textarea>
						
						<textarea name="folder_desc_eng" class="form-control leng" ><?php echo ($fid>0 && !empty($foldername))? $foldername->description_eng:'';?></textarea>
						
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save Folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Delete Folder Modal -->
	<div class="modal fade" id="deleteFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Delete this folder:</h4>
		  </div>
		  {!! Form::open(array('url'=>'folderdelete', 'class'=>'columns' ,'id' =>'folder_delete', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			Are you sure you want to delete the folder and all his files and subfolders?
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete folder</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- New File Modal -->
	<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Upload new file</h4>
		  </div>
		  {!! Form::open(array('url'=>'addfile', 'class'=>'columns' ,'id' =>'file_new', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" id="uploadfile_fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select Files <em>*</em></label>
				</div>
				 <div class="dropzone" id="dropzoneFileUpload"> </div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="location.reload();">Save & Continue</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Copy Folder File Modal -->
	<div class="modal fade" id="copyFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Copy selected files to:</h4>
		  </div>
		  {!! Form::open(array('url'=>'copyfolderfile', 'class'=>'columns' ,'id' =>'file_copy', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="copy_to" class="form-control" required="required">
						<option value=""> --Select Folder-- </option>
						</select>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Copy</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Move Folder File Modal -->
	<div class="modal fade" id="moveFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Move selected files to:</h4>
		  </div>
		  {!! Form::open(array('url'=>'movefolderfile', 'class'=>'columns' ,'id' =>'file_move', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Select folder <em>*</em></label>
					<div class="field-input">
						<select name="move_to" class="form-control" required="required">
						<option value=""> --Select Folder-- </option>
						</select>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Move</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Delete Folder File Modal -->
	<div class="modal fade" id="deleteFolderFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Delete selected files:</h4>
		  </div>
		  {!! Form::open(array('url'=>'deletefilefolder', 'class'=>'columns' ,'id' =>'file_delete', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			Are you sure you want to delete the selected items?
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder downloaded as Zip Archive -->
	{!! Form::open(array('url'=>'seletedfileszip', 'class'=>'columns' ,'id' =>'file_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder downloaded as Low PDF -->
	{!! Form::open(array('url'=>'seletedfileslowPdf', 'class'=>'columns' ,'id' =>'lowpdf_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder downloaded as High PDF -->
	{!! Form::open(array('url'=>'seletedfileshighPdf', 'class'=>'columns' ,'id' =>'highpdf_download', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Entire Folder downloaded as Zip Archive -->
	{!! Form::open(array('url'=>'entirefolderzip', 'class'=>'columns' ,'id' =>'entire_download', 'method'=>'post' )) !!}
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files in Flip book -->
	{!! Form::open(array('url'=>'makeflipbook', 'class'=>'columns' ,'id' =>'flipbook', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		<input type="hidden" name="fliptype" id="fliptype" value="high">
	</form>
	
	<!-- Permissions Folder Modal -->
	<div class="modal fade" id="Directorypermission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Set permissions for this folder:</h4>
		  </div>
		  {!! Form::open(array('url'=>'folderpermission', 'class'=>'columns' ,'id' =>'SximoTable', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="parent_id" value="@if(!empty($foldername)){{$foldername->parent_id}}@endif">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>User</th>
						<th colspan="2">Permissions</th>
					</tr>
				</thead>
				<tbody>
				
				@if(!empty($users))
					<?php $i=0; ?>
					@foreach($users as $user)
					<tr id="user_32119" class="search-match status-match ">
						<td class="rowtitle active">
						{{$user->first_name.' '.$user->last_name}}
						</td>
						@if(!empty($foldername))
							@if($foldername->parent_id>0)
								<td id="inherit_{{$user->id}}">
									<label>
										<input type="radio" rel="{{$user->id}}" class="inherit no-border" value="1" name="user[{{$i}}][inherit]" <?php if(!empty($permissions[$user->id])){ if($permissions[$user->id]->inherit==1){ echo 'checked="checked"'; } elseif($permissions[$user->id]->no_permission==0 && $permissions[$user->id]->view==0 && $permissions[$user->id]->upload==0 && $permissions[$user->id]->download==0 && $permissions[$user->id]->delete==0 && $permissions[$user->id]->inherit==0 && (!empty($foldername) && $foldername->parent_id>0)){ echo 'checked="checked"'; } } else { echo 'checked="checked"';} ?> > Inherit	
									</label>
								</td>
							@endif
						@endif
						<td id="none_{{$user->id}}">
							<label>
								<input type="hidden" name="user[{{$i}}][id]" value="{{$user->id}}">
								<input type="hidden" name="user[{{$i}}][per_id]" value="<?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->id!='')?$permissions[$user->id]->id:''; ?>">
								<input type="radio" rel="{{$user->id}}" class="none no-border" value="1" name="user[{{$i}}][no_permission]" <?php if(!empty($permissions[$user->id])){ if($permissions[$user->id]->no_permission==1){ echo 'checked="checked"'; } elseif($permissions[$user->id]->no_permission==0 && $permissions[$user->id]->view==0 && $permissions[$user->id]->upload==0 && $permissions[$user->id]->download==0 && $permissions[$user->id]->delete==0 && $permissions[$user->id]->inherit==0 && (!empty($foldername) && $foldername->parent_id==0)){ echo 'checked="checked"'; } }else{ if(!empty($foldername) && $foldername->parent_id==0){ echo 'checked="checked"';} } ?> > None	
							</label>
						</td>
						<td id="permis_{{$user->id}}">
							<label>
								<input type="checkbox" class="list no-border row view" rel="{{$user->id}}" rel2="view" name="user[{{$i}}][view]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->view==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > View</label>
							<label>
								<input type="checkbox" class="read no-border row download" rel="{{$user->id}}" rel2="download" name="user[{{$i}}][down]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->download==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Download</label>
							<label>
								<input type="checkbox" class="create no-border row upload" rel="{{$user->id}}" rel2="upload" name="user[{{$i}}][up]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->upload==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Upload</label>
							<label>
								<input type="checkbox" class="delete no-border row" rel="{{$user->id}}" rel2="delete" name="user[{{$i}}][del]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->delete==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Delete</label>
						</td>
					</tr>
					<?php $i++; ?>
					@endforeach
				@endif
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Set Permissions</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Global permission Modal -->
	<div class="modal fade" id="globalDirectorypermission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Global Permission:</h4>
		  </div>
		  {!! Form::open(array('url'=>'globalPermission', 'class'=>'columns' ,'id' =>'global_permission', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			You have given global rights to this folder.
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary" onclick="return getConfirmation();">Set Permission</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- remove Global permission Modal -->
	<div class="modal fade" id="RemoveglobalDirectorypermission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Remove Global Permission:</h4>
		  </div>
		  {!! Form::open(array('url'=>'removeglobalPermission', 'class'=>'columns' ,'id' =>'removeglobal_permission', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <div class="modal-body">
			Are you sure you want to remove the global permission of this folder?
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Remove Permission</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Send Email Modal -->
	<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">SHARE</h4>
		  </div>
		  {!! Form::open(array('url'=>'sendemail_flipbook', 'class'=>'columns' ,'id' =>'send_email', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="selecteditems" class="selecteditems" id="share_selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtype') }} <em>*</em> </label>
					<div class="field-input">
						<input type="checkbox" value="download" name="emailType[]" id="displaydown" checked="checked"> Download links &nbsp;
						<input type="checkbox" value="slideshow" name="emailType[]"> Show slideshow of images &nbsp;
						<input type="checkbox" value="flipbook" name="emailType[]" id="displayres"> View flipbook &nbsp;
						
					</div>
				</div>
				<div class="form-group" id="dltype">
					<div class="field-input">
						<input type="radio" value="zip-zip" name="downType" checked="checked" required> Download as Zip archive.&nbsp;
						<input type="radio" value="pdf-high" name="downType" required> Download as PDF high res.
						<input type="radio" value="pdf-low" name="downType" required> Download as PDF low res.&nbsp;
					</div>
				</div>
				<div class="form-group" id="fltype" style="display:none;">
					<div class="field-input">
						<input type="radio" value="high" name="flipType" checked="checked" required> Flipbook as high res.&nbsp;
						<input type="radio" value="low" name="flipType" required> Flipbook as low res.
						
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailto') }} <em>*</em></label>
					<div class="field-input">
						<input type="hidden" name="emailids" id="enteremail" class="form-control" style="padding:0;" value="" >
						
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailsubject') }} <em>*</em></label>
					<div class="field-input">
						{!! Form::text('subject',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!}
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtemplate') }} <em>*</em></label>
					<div class="field-input">
						<select name="emailTemplate" class="form-control" required="required">
							<option value=""> --Select -- </option>
							<option value="container_template1"> Template One </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailmessage') }}<em>*</em></label>
					<div class="field-input">
						<textarea class="form-control editor" rows="15" required name="message">
							
						</textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<span id="sharemasage" style="color:red; font-weight:bold; float:left;"></span>
			<button type="submit" class="btn btn-primary" onclick="return check_selecteditems();">SHARE</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign Attributes Folder File Modal -->
	<div class="modal fade" id="assignAttribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign attributes to selected files: <span style="float: right;margin-right: 10px;"><a href="{{URL::to('attributes/update')}}" target="_blank" >Create new attribute</a></span></h4>
			
		  </div>
		  {!! Form::open(array('url'=>'assignAttribute', 'class'=>'columns form-horizontal' ,'id' =>'assign_attribute', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label class="col-md-2">Description</label>
					<div class="col-md-8">
						<textarea name="product_desc" class="form-control"></textarea> 
					</div>
					<div class="col-md-2">
						
					</div>
				</div>
				<div class="form-group repeatAttr1">
					<label class="col-md-2">Attributes <span class="asterix"> * </span></label>
					<div class="col-md-8">
						<div class="row mainattr1 MrgBot10">
							<div class="col-md-12">
								<select name="assigned_attributes[]" id="assigned_attributes1" class="form-control" required="required" onchange="customOptions(this.value, 1);">
									<option value=""> --Select-- </option>
									@if(!empty($sel_attributes))
										@foreach($sel_attributes as $attr)
										  <option value="<?php echo $attr->attr_type .'-'.$attr->id .'-'.$attr->attr_cat; ?>"><?php echo $attr->attr_title; ?></option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="row" id="custmOpt1" style="display:none;">
							<div class="col-md-12">
								<div class="row attrf">
									&nbsp;
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 mainButt">
						<button type="button" onclick="addAttribute(1)" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign tags Folder File Modal -->
	<div class="modal fade" id="assignTags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign tags to selected files:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignTags', 'class'=>'columns form-horizontal' ,'id' =>'assign_tags', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<h4 class="modal-title">Add New Tag <small>(Add multiple tags seperated by comma(s).)</small></h4>
							</div>
							<div class="col-md-12 MrgTop10">
								<label class=" control-label col-md-4 text-left">Tag Title<em>*</em></label>
								<div class="field-input col-md-8">
									 {!! Form::text('tag_title', '',array('class'=>'form-control', 'placeholder'=>'', 'id'=>'tag_title'   )) !!}
								</div>
							</div>
							<div class="col-md-12 MrgTop10">
								<label class=" control-label col-md-4 text-left">Parent Tag<em>*</em></label>
								<div class="field-input col-md-8">
									 <select name='parent_tag_id' id='parent_tag_id' rows='5'   class='select2 '  > 
										<option  value ="0">-- Select Category --</option> 
										@foreach($parent_tags as $val)
										
											<option  value ="{{$val['id']}}">{{$val['name']}}</option> 						
										@endforeach						
									</select> 
								</div>
							</div>
							<div class="col-md-12 MrgTop10">
								<label class="col-sm-4 text-right">&nbsp;</label>
								<div class="col-sm-8">	
									<button type="button" name="newtag" class="btn btn-primary btn-sm" onclick="addnewTag();" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
								</div>
						  </div>
						</div>
					</div>
					<div class="col-md-5" style="border-left:1px solid #000;">
						<div class="row">
							<div class="col-md-12">
								<h4 class="modal-title">Search Tags</h4>
							</div>
							<div class="col-md-12 MrgTop10">
								<input type="text" name="searchtag" id="searchtag" value="" onkeyup="searchTags(this);" onkeydown="searchTags(this);" />
							</div>
							<div class="col-md-12 MrgTop10">
								<h4 class="modal-title">Tag List</h4>
							</div>
							<div class="col-md-12 MrgTop10 taglist">
							@if(!empty($sel_tags))
								@foreach($sel_tags as $tag)
									<div class="field-input MrgBot10">
										<input type="checkbox" value="{{$tag->id}}" name="selTag[]" id="{{$tag->id}}"> <label for="{{$tag->id}}">&nbsp;{{$tag->tag_title}}</label>
									</div>
								@endforeach
							@endif
							</div>
						</div>
						
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign Tag</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign Main Image Folder Modal -->
	<div class="modal fade" id="assignMainImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign Main Image:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignMainImage', 'class'=>'columns' ,'id' =>'assignMainImage', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="col-md-6">
						<h4 class="modal-title MrgBot10">IF Image Selected:</h4>
						<label>Select folder <em>*</em></label>
						<div class="field-input">
							<select name="cover_fold" class="form-control">
							<option value=""> --Select Folder-- </option>
							</select>
						</div>
					</div>
					<div class="col-md-6" style="border-left:1px solid #000;">
						<h4 class="modal-title MrgBot10">IF Folder Selected:</h4>
						<label>Upload Image <em>*</em></label>
						<div class="field-input">
							<input type="file" name="main_img" class="form-control" />
						</div>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder as frontend -->
	{!! Form::open(array('url'=>'seletedfilesfrontend', 'class'=>'columns' ,'id' =>'file_frontend', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- UNassign Selected Files/Folder as frontend -->
	{!! Form::open(array('url'=>'unassign_seletedfilesfrontend', 'class'=>'columns' ,'id' =>'unassign_file_frontend', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Assign Designer Modal -->
	<div class="modal fade" id="assignDesigner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign Designer:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignDesigner', 'class'=>'columns' ,'id' =>'assignDesigner', 'method'=>'post' )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label>Select Designer <em>*</em></label>
					<div class="field-input">
						<select name="designer" class="form-control" required="required">
						<option value=""> --Select Designer-- </option>
							@if(!empty($sel_designer))
								@foreach($sel_designer as $designr)
									<option value="{{$designr->id}}">{{$designr->designer_name}}</option>
								@endforeach
							@endif
						</select>
					</div>					
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder as frontend slider -->
	{!! Form::open(array('url'=>'seletedfilesfrontendslider', 'class'=>'columns' ,'id' =>'frontend_slider', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder as frontend slider -->
	{!! Form::open(array('url'=>'add_slider_variant_folder', 'class'=>'columns' ,'id' =>'create_folders', 'method'=>'post' )) !!}
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="folder" id="newfoldername" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	
	<!-- Landing page product Modal -->
	<div class="modal fade" id="assignlandingProducts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign Landing Page Products</h4>
		  </div>
		  {!! Form::open(array('url'=>'landing_page_products', 'class'=>'columns' ,'id' =>'landing_page_products', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="field">
					<label>Position <em>*</em></label>
					<div class="field-input">
						<select name="product_pos" class="form-control" required="required">
							<option value="1">Position 1</option>
							<option value="2">Position 2</option>
							<option value="3">Position 3</option>
						</select>
					</div>
				</div>
				<div class="field">
					<label>Title <em>*</em></label>
					<div class="field-input">
						<input name="product_title" class="form-control" type="text" value="">
					</div>
				</div>
				<div class="field">
					<label>Marketing message <em>*</em></label>
					<div class="field-input">
						<input name="product_message" class="form-control" type="text" value="" required="required">
					</div>
				</div>
				<div class="field">
					<label>Description <em>*</em></label>
					<div class="field-input">
						<textarea name="product_desc" class="form-control"></textarea>
					</div>
				</div>
				<div class="field">
					<label>URL <em>*</em></label>
					<div class="field-input">
						<input name="product_url" class="form-control" type="text" value="">
					</div>
				</div>
				<div class="field">
					<label>Upload Image <em>*</em><small>Image Dimensions 320 x 385</small></label>
					<div class="field-input">
						<input name="product_img" class="form-control" type="file">
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Selected Files/Folder as activate lightbox -->
	{!! Form::open(array('url'=>'seletedfiles_activatelightbox', 'class'=>'columns' ,'id' =>'activate_lightbox', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
	<!-- Selected Files/Folder as deactivate lightbox -->
	{!! Form::open(array('url'=>'seletedfiles_deactivatelightbox', 'class'=>'columns' ,'id' =>'deactivate_lightbox', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="fold_id" value="{{$fid}}">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	
<div id="fixed_wrapper">
	<!-- Lightbox Modal -->
	<div id="lightbox_basket_wrapper">
		<div id="lightbox_basket_trigger">
			<a href="#" class="link-to-show active" onclick="hide_show_lightbox('show');">Merkzettel<span class="arrow_down"></span></a>
			<a href="#" class="link-to-hide" onclick="hide_show_lightbox('hide');">Merkzetl<span class="arrow_down"></span></a>
		</div>

		<div id="lightbox_basket">
			<div id="lightbox_basket_content">
				<div id="lightbox_outer_wrapper">
					<!--<div id="create_lightbox" class="attached">
						
						<div class="lightbox_addon">
							<button type="button" class="textButton" onclick="createnewbox();">Neu Merkzettel erstellen +</button>
						</div>
					</div>-->
					{{--*/ $lb=0; $lb_itm=0; /*--}}
					@if(!empty($lightboxes))
						{{--*/ $lb= count($lightboxes); /*--}}
						@foreach($lightboxes as $lboxes)
							<div class="single_lightbox_wrapper{{$lboxes->id}} single_lightbox_wrappertemp attached">
								<input type="hidden" name="editlightboxid" id="editlightboxid" value="{{$lboxes->id}}" />
								<div class="single_lightbox_inner_wrapper">
									<div class="single_lightbox_wrapper_left">
										<div class="single_lightbox_title" data-lightbox-field="title">
											<span id="lightbox_title">{{$lboxes->box_name}}</span>
											<a href="#" class="lightbox_rename" onclick="show_rename_form({{$lboxes->id}});">Umbenennen</a>
											<div class="lightbox_rename_wrapper disnon">
												<input type="text" value="{{$lboxes->box_name}}" name="editval" class="textbox{{$lboxes->id}}" style="width:150px;">
												<button type="button" onclick="lightbox_update_name({{$lboxes->id}});">Save</button>
											</div>
										</div>
										<!--<div class="single_lightbox_controls">
											<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('{{$lboxes->id}}');">Entfernen</button>
										</div>-->

										<div class="single_lightbox_controls">
											<a href="{{URL::to('lightbox_content_downloadpdf/'.$lboxes->id)}}" class="textButton arrowButton default" ><i class="fa fa-download"></i> Download PDF</a>
											<a href="#" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail_lightbox" onclick="getlightbox($lboxes->id);"><i class="fa fa-envelope"></i>  Share Lightbox</a>
										</div>
									</div>

									<div class="single_lightbox_wrapper_right">
										<ul>										
											@if(!empty($lightcontent[$lboxes->id]))
												{{--*/ $lb_itm = count($lightcontent[$lboxes->id]); /*--}}
												@foreach($lightcontent[$lboxes->id] as $cont)
													<li id="imgfile{{$cont->id}}">
														<a href="#">
														{{--*/ $explFile = explode('.',$cont->file_name); 
															    $lext = end($explFile); 
														/*--}}
														
														@if($lext=="jpg" || $lext=="png" || $lext=="gif" || $lext=="bmp" || $lext=="jpeg" || $lext=="JPG")
															<img src="{{URL::to('uploads/thumbs/').'/thumb_'.$cont->folder_id.'_'.$cont->file_name}}" alt="{{$cont->file_display_name}}">
														@elseif($lext=="pdf")
															<img src="{{URL::to('uploads/images/pdf_icon_klein.png')}}" alt="{{$cont->file_display_name}}">
														@elseif($lext=="docx" || $lext=="doc")
															<img src="{{URL::to('uploads/images/doc_icon_klein.png')}}" alt="{{$cont->file_display_name}}">
														@endif
															<p>{{$cont->file_title}}</p>

														</a>
														
														<button type="button" class="remove_article" onclick="remove_boxcontent({{$cont->id}});">
															<img src="{{ asset('sximo/images/remove.gif')}}" alt="Delete">
														</button>
													</li>
												@endforeach
											@endif
										</ul>

										<div class="single_lightbox_showmore"><a class="arrowButton textButton" href="#">Show all</a></div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
					<input type="hidden" name="tot_lb" id="tot_lb" value="{{$lb}}" />
					<input type="hidden" name="tot_lb_itm" id="tot_lb_itm" value="{{$lb_itm}}" />
				</div>
			</div>
		</div>
	</div>
</div>

<!-- choose lightbox Modal -->
<div class="modal fade" id="chooselight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Choose Merkzettel:</h4>
	  </div>
	  <div class="modal-body">
		<div class="field">
			<label>Please select a Merkzettel <em>*</em></label>
			<div class="field-input">
				<input type="hidden" name="chsfile" id="chsfile" value="" />
				<select name="chslightboxes" id="chslightboxes" class="form-control">
				@foreach($lightboxes as $opt)
				  <option value="<?php echo $opt->id; ?>"><?php echo $opt->box_name; ?></option>
				@endforeach
				</select>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="selectlightbox();">zur Lightbox hinzufügen</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<!-- Send Email lightbox Modal -->
	<div class="modal fade lightboxmodal" id="sendEmail_lightbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="text-align:left;">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Share Lightbox</h4>
		  </div>
		  {!! Form::open(array('url'=>'sendemail_lightbox', 'class'=>'columns' ,'id' =>'send_email_lightbox', 'method'=>'post' )) !!}
		  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="selecteditems" class="selecteditems" id="share_selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtype') }} <em>*</em> </label>
					<div class="field-input">
						<input type="checkbox" value="download" name="emailType[]" id="displaydown" checked="checked" onclick="show_hide_downloadoptions();"> Download links &nbsp;
					</div>
				</div>
				<div class="form-group" id="dltype">
					<div class="field-input">
						<input type="radio" value="zip-zip" name="downType" checked="checked" required> Download as Zip archive.&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailto') }} <em>*</em></label>
					<div class="field-input">
						<input type="hidden" name="emailids" id="enteremail_lightbox" class="form-control" style="padding:0;" value="" >
						
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailsubject') }} <em>*</em></label>
					<div class="field-input">
						{!! Form::text('subject',null,array('placeholder'=>'','required'=>'true', 'class'=>'form-control' )) !!}
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailtemplate') }} <em>*</em></label>
					<div class="field-input">
						<select name="emailTemplate" required="required" class="form-control">
							<option value=""> --Select -- </option>
							<option value="lightbox_template1"> Template One </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>{{ Lang::get('core.fr_emailmessage') }}<em>*</em></label>
					<div class="field-input">
						<textarea class="form-control editor" rows="15" required name="message" >
							
						</textarea>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<span id="sharemasage" style="color:red; font-weight:bold; float:left;"></span>
			<button type="submit" class="btn btn-primary">Send</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Assign PDF Image file Modal -->
	<div class="modal fade" id="assignPdfImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Assign PDF Image:</h4>
		  </div>
		  {!! Form::open(array('url'=>'assignPdfImage', 'class'=>'columns' ,'id' =>'assignPdfImage', 'method'=>'post', 'files'=>true )) !!}
		  <input type="hidden" name="fold_id" value="{{$fid}}">
		  <input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
		  <input type="hidden" name="selecteditems" class="selecteditems" value="">
		  <div class="modal-body">
			<fieldset>
				<div class="form-group">
					<div class="col-md-12">
						<label>Upload Image <em>*</em></label>
						<div class="field-input">
							<input type="file" name="pdf_img" class="form-control" />
						</div>
					</div>
				</div>
			</fieldset>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Assign</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<input type="hidden" id="sort_num" value="" />
	
	<!-- Selected Files/Folder as landing page products -->
	{!! Form::open(array('url'=>'seletedfolderslanding', 'class'=>'columns' ,'id' =>'assign_categories_landing', 'method'=>'post' )) !!}
		<input type="hidden" name="selectedfiles" class="selectedfiles" value="">
		<input type="hidden" name="curnurl" value="{{ Request::url().'?show='.$showType }}">
	</form>
	<script>
	
		function submit_folder_form(formId, foldername)
		{
			if(formId!='' && foldername!='')
			{
				$('#newfoldername').val(foldername);
				$('#'+formId).submit();
			}
		}
		
		$(function(){
			var fid = '<?php echo $fid; ?>';
			$('.parent'+fid).parents().show();
			$('.parent'+fid).show();
			
			$("#enteremail").select2({
			  tags: [
			  <?php if(!empty($crmusers)) { foreach($crmusers as $emailOBJ){
					
					echo '"'.$emailOBJ->Email .'",';
					
			  } }	?>
			  ],
			  tokenSeparators: [',', ' ']
			});
			
			$("#enteremail_lightbox").select2({
			  tags: [
			  <?php if(!empty($crmusers)) { foreach($crmusers as $emailOBJ){
					
					echo '"'.$emailOBJ->Email .'",';
					
			  } }	?>
			  ],
			  tokenSeparators: [',', ' ']
			});
			
			
			$('input[type="checkbox"][id="displayres"]').on('ifChecked', function(){
				$("#fltype").show();
			});
			
			$('input[type="checkbox"][id="displayres"]').on('ifUnchecked', function(){
				$("#fltype").hide();
			});
			
			$('input[type="checkbox"][id="displaydown"]').on('ifChecked', function(){
				$("#dltype").show();
			});
			
			$('input[type="checkbox"][id="displaydown"]').on('ifUnchecked', function(){
				$("#dltype").hide();
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifChecked', function(){
				$('input[type="checkbox"].ff').iCheck('check');
			});
			
			$('input[type="checkbox"][id="check_all"]').on('ifUnchecked', function(){
				$('input[type="checkbox"].ff').iCheck('uncheck');
			});
			
			$('.none').on('ifChecked', function(){
				var id = $(this).attr('rel');
				$('#permis_'+id+' input[type="checkbox"]').iCheck('uncheck');
				$('#inherit_'+id+' input[type="radio"]').iCheck('uncheck');
			});
			
			$('.inherit').on('ifChecked', function(){
				var id = $(this).attr('rel');
				$('#permis_'+id+' input[type="checkbox"]').iCheck('uncheck');
				$('#none_'+id+' input[type="radio"]').iCheck('uncheck');
			});
			
			$('input.row').on('ifClicked', function(){
				var rel = $(this).attr('rel');
				var rel2 = $(this).attr('rel2');
				$('#none_'+rel+' input[type="radio"]').iCheck('uncheck');
				$('#inherit_'+rel+' input[type="radio"]').iCheck('uncheck');
				if(rel2=='delete')
				{
					$('#permis_'+rel+' input[type="checkbox"].view').iCheck('check');
					$('#permis_'+rel+' input[type="checkbox"].upload').iCheck('check');
					$('#permis_'+rel+' input[type="checkbox"].download').iCheck('check');
				}
				else if(rel2=='upload')
				{
					$('#permis_'+rel+' input[type="checkbox"].view').iCheck('check');
					$('#permis_'+rel+' input[type="checkbox"].download').iCheck('check');
					$('#permis_'+rel+' input[type="checkbox"].delete').iCheck('uncheck');
				}
				else if(rel2=='download')
				{
					$('#permis_'+rel+' input[type="checkbox"].view').iCheck('check');
					$('#permis_'+rel+' input[type="checkbox"].delete').iCheck('uncheck');
					$('#permis_'+rel+' input[type="checkbox"].upload').iCheck('uncheck');
				}
				else if(rel2=='view')
				{
					console.log('vidisidisd');
					$('#permis_'+rel+' input[type="checkbox"].download').iCheck('uncheck');
					$('#permis_'+rel+' input[type="checkbox"].upload').iCheck('uncheck');
					$('#permis_'+rel+' input[type="checkbox"].delete').iCheck('uncheck');
				}
			});
			
			<?php if($fid>0) { ?>
			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					<?php foreach($imgfancy as $imgOBJ){
					
					echo '{href:'.'"'.$imgOBJ.'"},';
					
				}	?>
				], {
					helpers : {
						buttons	: {},
						overlay: { closeClick: false }
					}
				});
			});
			<?php } ?>
			
			$( "#container_sortable" ).sortable({
				stop: function() {
				update_container_sort_num();
			  }
			});
			$( "#container_sortable" ).disableSelection();
		});
		
		function update_container_sort_num()
		{
			$('#sort_num').val('');
			var fList = "";
			$('.gallery-box').each(function () {
				fList += (fList=="" ? $(this).find("input[type=checkbox].ff").val() : "," + $(this).find("input[type=checkbox].ff").val());
				
			});
			$('#sort_num').val(fList);
			var foldr = '<?php echo $fid; ?>';
			$.ajax({
			  url: "{{ URL::to('update_container_sortnum')}}",
			  type: "post",
			  data: "items=" + $('#sort_num').val()+'&foldId='+foldr,
			  dataType: "json",
			  success: function(data){
				if(data!='error')
				{
					console.log('sorting Done');
				}
			  }
			});
		}
		
		function selectfolderfiles()
		{
			$('.selecteditems').val('');
			var sList = "";
			$('input[type=checkbox].ff').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			$('.selecteditems').val(sList);
		}
		
		function select_folderfilesfor_download(formId, typ)
		{
			var sList = "";
			$('input[type=checkbox].ff').each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			$('.selectedfiles').val(sList);
			$('#fliptype').val(typ);
			$( "#"+formId ).submit();
			
		}
		
		function entire_folderfilesfor_download()
		{
			$( "#entire_download" ).submit();	
		}
		
		
		var baseUrl = "{{ url::to('addfile') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
             var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                url: baseUrl,
                params: {
                    _token: token,
					fold_id:$("#uploadfile_fold_id").val()
                },
				paramName: "file", // The name that will be used to transfer the file
				addRemoveLinks: true,
				success: function(file, response){
					
				}
             });
			 
		function getConfirmation(){
		   var retVal = confirm("When setting global permissions for this folder. you are setting permissions for all its sub folders. Do you want to continue ?");
		   if( retVal == true ){
			  return true;
		   }
		   else{
			  return false;
		   }
		}
		
		function customOptions(objVal, indx)
		{
			var str = '';
			var str_sel = '';
			if(objVal!='')
			{
				var exp_val = objVal.split("-");
				if(exp_val[0]=='dropdown' || exp_val[0]=='radio' || exp_val[0]=='checkboxes')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					$.ajax({
					  url: "{{ URL::to('getAttributeOptions')}}",
					  type: "post",
					  data: "attr_id="+exp_val[1],
					  dataType: "json",
					  success: function(data){
						if(data!='error')
						{
							str_sel += '<div class="row MrgBot10 seloption">';
							str_sel += '<div class="col-md-12">';
							str_sel += '<select name="selected_attributes['+exp_val[1]+'][]" class="js-example-basic-multiple'+indx+'"  required="required" multiple="multiple" style="width:100%">';
							$.each(data, function(idx, obj) {
								str_sel += '<option value="'+obj.id+'">'+obj.option_name+'</option>';
							});
							str_sel += '</select>';
							str_sel += '</div>';
							str_sel += '</div>';
							$('.mainattr'+indx).after(str_sel);
							$(".js-example-basic-multiple"+indx).select2();
						}
					  }
					});
					
					var cls = 'col-md-5';
					if(exp_val[2]=='Materialien' || exp_val[2]=='Materialien_additional')
					{
						cls = 'col-md-3';
					}
					str += '<div class="clone'+indx+'">';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_values['+exp_val[1]+'][]" value="" placeholder="Value" class="form-control">';
					str += '</div>';
					str += '<div class="'+cls+'">';
					str += '<input type="text" name="opt_name['+exp_val[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					str += '</div>';
					if(exp_val[2]=='Materialien' || exp_val[2]=='Materialien_additional')
					{
						str += '<div class="col-md-4">';
						str += '<input type="file" name="opt_imgs['+exp_val[1]+'][]" class="form-control">';
						str += '</div>';
					}
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
				}
				else if(exp_val[0]=='text')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><input type="text" name="assigned_text['+exp_val[1]+']" value="" class="form-control" required /></div>';
				}
				else if(exp_val[0]=='textarea')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="col-md-12"><textarea name="assigned_textarea['+exp_val[1]+']" class="form-control" required></textarea></div>';
				}
				else if(exp_val[0]=='file')
				{
					$('.repeatAttr'+indx+' div.seloption').remove();
					str += '<div class="clone'+indx+'">';
					str += '<div class="col-md-10"><input type="file" name="assigned_file['+exp_val[1]+'][]" class="form-control" required="required" /></div>';
					str += '<div class="col-md-2 butt">';
					str += '<button type="button" onclick="addItem('+indx+', '+indx+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
					str += '</div>';
					str += '</div>';
					//str += '<div class="col-md-12"><input type="file" name="assigned_file['+exp_val[1]+']" class="form-control" required /></div>';
				}
				$('#custmOpt'+indx+' .attrf').html(str);
				$('#custmOpt'+indx).show();
			}
			else
			{
				$('#custmOpt'+indx+' .attrf').html('');
				$('.repeatAttr'+indx+' div.seloption').remove();
				$('#custmOpt'+indx).hide();
			}
		}
		
		function addItem(id, mainid)
		{
			if(id!="")
			{
				$('.repeatAttr'+mainid+' .clone'+id+' .butt button').remove();
				var remBut = '<button type="button" onclick="removeItem('+id+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatAttr'+mainid+' .clone'+id+' .butt').append(remBut);
				var newid = parseInt(id) + 1;
				var cls = 'col-md-5';
				var attrId = $('.repeatAttr'+mainid+' #assigned_attributes'+mainid).val();
				var exp_attrId = attrId.split("-");
				if(exp_attrId[0]=="file")
				{
					var html = '<div class="clone'+newid+'">';
					html += '<div class="col-md-10"><input type="file" name="assigned_file['+exp_attrId[1]+'][]" class="form-control" required="required" /></div>';
				}
				else{
					var title = $('.repeatAttr'+mainid+' #assigned_attributes'+mainid+' option:selected').text();
					if(exp_attrId[2]=='Materialien' || exp_attrId[2]=='Materialien_additional')
					{
						cls = 'col-md-3';
					}
					var html = '<div class="clone'+newid+'">';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_values['+exp_attrId[1]+'][]" value="" placeholder="Value" class="form-control">';
					html += '</div>';
					html += '<div class="'+cls+'">';
					html += '<input type="text" name="opt_name['+exp_attrId[1]+'][]" value="" placeholder="Display Name" class="form-control">';
					html += '</div>';
					if(exp_attrId[2]=='Materialien' || exp_attrId[2]=='Materialien_additional')
					{
						html += '<div class="col-md-4">';
						html += '<input type="file" name="opt_imgs['+exp_attrId[1]+'][]" class="form-control">';
						html += '</div>';
					}
				}
				
				html += '<div class="col-md-2 butt">';
				html += '<button type="button" onclick="addItem('+newid+', '+mainid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div>';
				$('.repeatAttr'+mainid+' .clone'+id).after(html);
			}
		}
		
		function removeItem(id)
		{
			if(id!="")
			{
				$('.clone'+id).remove();
			}
		}
		
		function addAttribute(id, mainid)
		{
			if(id!="")
			{
				$('.repeatAttr'+id+' .mainButt button').remove();
				var remBut = '<button type="button" onclick="removeAttributes('+id+')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
				$('.repeatAttr'+id+' .mainButt').append(remBut);
				var newid = parseInt(id) + 1;
				
				var html = '';
				html += '<div class="form-group repeatAttr'+newid+'">';
				html += '<label class="col-md-2">Attributes <span class="asterix"> * </span></label>';
				html += '<div class="col-md-8">';
				html += '<div class="row mainattr'+newid+' MrgBot10">';
				html += '<div class="col-md-12">';
				html += '<select name="assigned_attributes[]" id="assigned_attributes'+newid+'" class="form-control" required="required" onchange="customOptions(this.value, '+newid+');">';
				html += '<option value=""> --Select-- </option>';
				<?php if(!empty($sel_attributes)) {
						foreach($sel_attributes as $attr) { ?>
							html += '<option value="<?php echo $attr->attr_type .'-'.$attr->id .'-'.$attr->attr_cat; ?>"><?php echo $attr->attr_title; ?></option>';
					<?php	}
					}
				?>
				html += '</select>';
				html += '</div>';
				html += '</div>';
				html += '<div class="row" id="custmOpt'+newid+'" style="display:none;">';
				html += '<div class="col-md-12">';
				html += '<div class="row attrf">&nbsp;</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="col-md-2 mainButt">';
				html += '<button type="button" onclick="addAttribute('+newid+')" class="btn btn-success MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
				html += '</div>';
				html += '</div>';
				
				$('.repeatAttr'+id).after(html);
			}
		}
		
		function removeAttributes(id)
		{
			if(id!="")
			{
				$('.repeatAttr'+id).remove();
			}
		}
		
		function addnewTag()
		{
			var newtag = $.trim($("#tag_title").val());
			var newparent_tag = $.trim($("#parent_tag_id").val());
			if(newtag!='')
			{
				$.ajax({
				  url: "{{ URL::to('addnewtag')}}",
				  type: "post",
				  data: 'addtag='+newtag+'&parent_tag='+newparent_tag,
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						var tagstr = '';
						$.each(data, function(idx, obj) {
							tagstr += '<div class="field-input MrgBot10"><input type="checkbox" value="'+obj.id+'" name="selTag[]" id="'+obj.id+'"> <label for="'+obj.id+'">&nbsp;'+obj.tag_title+'</label></div>';
						});
						$('.taglist').html(tagstr);
						$('.taglist').find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
						$("#tag_title").val('');
					}
				  }
				});
			}
		}
		
		function searchTags(keyword)
		{
			var keywordtag = $.trim($(keyword).val());
			if(keywordtag!='')
			{
				$.ajax({
				  url: "{{ URL::to('search_exist_tag')}}",
				  type: "post",
				  data: 'keyword_tag='+keywordtag,
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						var tagstr = '';
						$.each(data, function(idx, obj) {
							tagstr += '<div class="field-input MrgBot10"><input type="checkbox" value="'+obj.id+'" name="selTag[]" id="'+obj.id+'"> <label for="'+obj.id+'">&nbsp;'+obj.tag_title+'</label></div>';
						});
						$('.taglist').html(tagstr);
						$('.taglist').find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
					}
				  }
				});
			}
		}
		
		function frontend_grid(img,cont_type,cont_id,act)
		{
			if(cont_id!='' && cont_id>0)
			{
				$.ajax({
				  url: "{{ URL::to('activate_deactivate_product_frontend')}}",
				  type: "post",
				  data: 'cont_type='+cont_type+'&cont_id='+cont_id+'&action='+act,
				  success: function(data){
					if(data!='error')
					{
						if(act==0)
						{
							$(img).attr("src","{{URL::to('uploads/images/activated.png')}}");
							$(img).attr("onclick","frontend_grid(this,'"+cont_type+"','"+cont_id+"',1)");
							$(img).attr("title","Click to Deactivate Frontend");
						}
						else if(act==1)
						{
							$(img).attr("src","{{URL::to('uploads/images/not_activated.png')}}");
							$(img).attr("onclick","frontend_grid(this,'"+cont_type+"','"+cont_id+"',0)");
							$(img).attr("title","Click to Activate Frontend");
						}
					}
				  }
				});
			}
		}
		
		function check_selecteditems()
		{
			var selecteditems = $('#share_selecteditems').val();
			if(selecteditems!="")
			{
				if (selecteditems.indexOf("file") >= 0)
				{
					return true;
				}
				else
				{
					$('#sharemasage').html('Please select only files.');
					return false;
				}
			}
			else
			{
				$('#sharemasage').html('Please select files first.');
				return false;
			}
		}
		
		function lightbox_grid(img,cont_id,act)
		{
			if(cont_id!='' && cont_id>0)
			{
				$.ajax({
				  url: "{{ URL::to('activate_deactivate_product_lightbox')}}",
				  type: "post",
				  data: '&cont_id='+cont_id+'&action='+act,
				  success: function(data){
					if(data!='error')
					{
						if(act==0)
						{
							$(img).attr("src","{{URL::to('uploads/images/activated_lightbox.png')}}");
							$(img).attr("onclick","lightbox_grid(this,'"+cont_id+"',1)");
							$(img).attr("title","Click to Deactivate Lightbox");
						}
						else if(act==1)
						{
							$(img).attr("src","{{URL::to('uploads/images/not_activated_lightbox.png')}}");
							$(img).attr("onclick","lightbox_grid(this,'"+cont_id+"',0)");
							$(img).attr("title","Click to Activate Lightbox");
						}
					}
				  }
				});
			}
		}
		
		function change_lang(lang)
		{
			if(lang=='dutch')
			{
				$('.ldutch').css('display', 'block');
				$('.leng').css('display', 'none');
			}
			else if(lang=='eng')
			{
				$('.ldutch').css('display', 'none');
				$('.leng').css('display', 'block');
			}
		}
		
		function hide_show_lightbox(act)
	{
		if(act!='')
		{
			if(act=="show")
			{
				$('.link-to-show').removeClass('active');
				$('.link-to-hide').addClass('active');
				$('#lightbox_basket').show();
				$('.container.foo-copy-right').css('margin-bottom','480px');
			}
			else if(act=="hide")
			{
				$('.link-to-hide').removeClass('active');
				$('.link-to-show').addClass('active');
				$('#lightbox_basket').hide();
				$('.container.foo-copy-right').css('margin-bottom','78px');
			}
		}
	}
	
	function createnewbox()
	{
		$.ajax({
		  url: "{{ URL::to('create_lightbox')}}",
		  type: "post",
		  dataType: "json",
		  success: function(data){
			if(data.status=='error')
			{
				alert(data.errors);
			}
			else if(data.status=='success')
			{
				var pdflink = "{{URL::to('lightbox_content_downloadpdf/"+data.lightbox.id+"')}}";
				var newlightdiv = '';
				newlightdiv += '<div class="single_lightbox_wrapper'+data.lightbox.id+' single_lightbox_wrappertemp attached">';
				newlightdiv += '<input type="hidden" name="editlightboxid" id="editlightboxid" value="'+data.lightbox.id+'" />';
				newlightdiv += '<div class="single_lightbox_inner_wrapper">';
				newlightdiv += '<div class="single_lightbox_wrapper_left">';
				newlightdiv += '<div class="single_lightbox_title" data-lightbox-field="title">';
				newlightdiv += '<span id="lightbox_title">'+data.lightbox.box_name+'</span>';
				newlightdiv += '<a href="#" class="lightbox_rename" onclick="show_rename_form('+data.lightbox.id+');">Umbenennen</a>';
				newlightdiv += '<div class="lightbox_rename_wrapper disnon">';
				newlightdiv += '<input type="text" value="'+data.lightbox.box_name+'" name="editval" class="textbox'+data.lightbox.id+'" style="width:150px;">';
				newlightdiv += '<button type="button" class="lightbox_rename" onclick="lightbox_update_name('+data.lightbox.id+');">Save</button>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				/*newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<button type="button" class="remove_lightbox textButton arrowButton" onclick="deletelightbox('+data.lightbox.id+')">Entfernen</button>';
				newlightdiv += '</div>';*/
				newlightdiv += '<div class="single_lightbox_controls">';
				newlightdiv += '<a href="'+pdflink+'" class="textButton arrowButton default">Download PDF</a>';
				newlightdiv += '<a href="" class="textButton arrowButton asLightbox lightbox_email cboxElement" data-toggle="modal" data-target="#sendEmail" onclick="getlightbox('+data.lightbox.id+');">Email</a>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '<div class="single_lightbox_wrapper_right">';
				newlightdiv += '<ul></ul>';
				newlightdiv += '</div>';
				newlightdiv += '</div>';
				newlightdiv += '</div>'; 
				
				$('#lightbox_outer_wrapper').append(newlightdiv);
				
				var get_tot_lb = parseInt($('#tot_lb').val());
				$('#tot_lb').val(get_tot_lb+1);
			}
		  }
		});
	}
	
	function deletelightbox(lightId)
	{
		if(lightId!="" && lightId > 0)
		{
			$.ajax({
			  url: "{{ URL::to('delete_lightbox')}}",
			  type: "post",
			  data: "lightboxId="+lightId,
			  success: function(data){
				if(data=='error')
				{
					alert('Merkzettel not found');
				}
				else if(data=='success')
				{
					$('.single_lightbox_wrapper'+lightId).remove();
					var get_tot_lb = parseInt($('#tot_lb').val());
					$('#tot_lb').val(get_tot_lb-1);
				}
			  }
			});
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function show_rename_form(boxid)
	{
		if(boxid!="" && boxid > 0)
		{
			$('.single_lightbox_wrapper'+boxid+' #lightbox_title').hide();
			$('.single_lightbox_wrapper'+boxid+' .lightbox_rename').hide();
			$('.single_lightbox_wrapper'+boxid+' .lightbox_rename_wrapper').show();
			//$('.single_lightbox_wrapper'+boxid+' .lightbox_rename').show();
		}
		else{
			alert('Merkzettel not found');
		}
	}
	
	function lightbox_update_name(lightId)
	{
		if(lightId!="" && lightId > 0)
		{
			var lightname = $.trim($('.textbox'+lightId).val());
			if(lightname!='')
			{
				$.ajax({
				  url: "{{ URL::to('lightboxupdatename')}}",
				  type: "post",
				  data: "lightboxId="+lightId+"&newname="+lightname,
				  success: function(data){
					if(data=='error')
					{
						alert('Merkzettel not found');
					}
					else if(data=='success')
					{
						$('.textbox'+lightId).val(lightname);
						$('.single_lightbox_wrapper'+lightId+' #lightbox_title').html(lightname);
						$('.single_lightbox_wrapper'+lightId+' #lightbox_title').show();
						$('.single_lightbox_wrapper'+lightId+' .lightbox_rename').show();
						$('.single_lightbox_wrapper'+lightId+' .lightbox_rename_wrapper').hide();
					}
				  }
				});
			}
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function add_to_lightbox()
	{
		var fileId = '';
		$('input[type=checkbox].ff').each(function () {
			if(this.checked)
			{
				fileId += (fileId=="" ? $(this).val() : "," + $(this).val());
			}
			
		});
		if(fileId!="")
		{
			var tot_box = $('#tot_lb').val();
			var tot_box_itms = $('#tot_lb_itm').val();
			if(tot_box>0)
			{
				var lid = '';
				if(tot_box_itms < 3)
				{
					if(tot_box>1)
					{
						$('#chooselight #chsfile').val(fileId);	
						$('#chooselight').modal('show');
					}
					else
					{
						lid = $('#editlightboxid').val();
						add_lightbox_content(fileId, lid);
					}
				}
				else
				{
					alert('You can not add more than 3 products to Merkzettel.');
				}
			}
			else
			{
				alert('BITTE ERSTELLEN SIE ZUERST EINEN MERKZETTEL BEVOR SIE EIN PRODUKT HINZUFÜGEN');
			}
		}
		else
			{
				alert('Please select files first.');
			}
	}
	
	function selectlightbox()
	{
		var chos_box = $('#chslightboxes').val();
		var chos_file = $('#chsfile').val();
		add_lightbox_content(chos_file, chos_box);
	}
	
	function add_lightbox_content(chos_file_id, chos_box_id)
	{
		if(chos_file_id !='' && chos_box_id > 0)
		{
			$.ajax({
			  url: "{{ URL::to('lightbox_addcontent_container')}}",
			  type: "post",
			  data: "lightboxId="+chos_box_id+"&fileId="+chos_file_id,
			  dataType: "json",
			  success: function(data){
				if(data.status=='error')
				{
					alert('Merkzettel not found');
				}
				else if(data.status=='success')
				{
					$.each(data.lightboxcontent, function(idx, obj) {
						var newcont = '';
						var img = "{!!URL::to('uploads/thumbs/thumb_" + obj.folder_id + "_" +  obj.file_name + "')!!}";
						var remimg = "{{ asset('sximo/images/remove.gif')}}";
						newcont +='<li id="imgfile'+obj.id+'">';
						newcont +='<a href="#">';
						newcont +='<img src="'+img+'" alt="'+obj.file_display_name+'">';
						newcont +='<p style="position:fixed;">'+ obj.file_title+'</p>';
						newcont +='</a>';
						newcont +='<button type="button" class="remove_article">';
						newcont +='<img src="'+remimg+'" alt="Delete" onclick="remove_boxcontent('+obj.id+');">';
						newcont +='</button>';
						newcont +='</li>';
						$('.single_lightbox_wrapper'+chos_box_id+' .single_lightbox_wrapper_right ul').append(newcont);
					});
					$('#chooselight').modal('hide');
					$('.link-to-show').removeClass('active');
					$('.link-to-hide').addClass('active');
					$('#lightbox_basket').show();
					$('.container.foo-copy-right').css('margin-bottom','480px');
					var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
					$('#tot_lb_itm').val(get_tot_lb_itm+1);
				}
			  }
			});
		}
		else{
			alert('Please choose a Merkzettel first');
		}
	}
	
	function remove_boxcontent(contentId)
	{
		if(contentId!="" && contentId > 0)
		{
			$.ajax({
			  url: "{{ URL::to('delete_lightbox_content')}}",
			  type: "post",
			  data: "contentId="+contentId,
			  success: function(data){
				if(data=='error')
				{
					alert('Merkzettel image not found');
				}
				else if(data=='success')
				{
					$('#imgfile'+contentId).remove();
					var get_tot_lb_itm = parseInt($('#tot_lb_itm').val());
					$('#tot_lb_itm').val(get_tot_lb_itm-1);
				}
			  }
			});
		}
		else
		{
			alert('Merkzettel not found');
		}			
	}
	
	function getlightbox(lid)
	{
		if(lid>0 && lid!='')
		{
			$('#share_selecteditems').val(lid);
		}
	}
			 
	</script>
	<script src="{{ asset('sximo/js/dynamitable.jquery.min.js') }}"></script>
	
	<script>
		function loadLeftSideTree(){
			$.ajax({
				url: '{{url("getFolderListAjax/")}}/{{(isset($fid) && $fid!="")?$fid:0}}?show={{(isset($_GET["show"]))?$_GET["show"]:""}}',
				type: "get",
				dataType: "html",
				success: function(data){
					$('[data-load="left-side-tree"]').hide();
					$('[data-load="left-side-tree"]').fadeIn('slow');
					$('[data-load="left-side-tree"]').html(data);
				}
			});
		}
		$(document).ready(function(){
			loadLeftSideTree();
			$(document).on('click','[data-action="expend-folder-tree"]',function(e){
				e.preventDefault();
				
				$('a[data-action="expend-folder-tree"]').removeClass('selected');
				$(this).addClass('selected');
				//$('a.selected[data-action="expend-folder-tree"]').next().after('<p class="loading">Loading...</p>');
				$.ajax({
					url: $(this).attr('href'),
					type: "get",
					dataType: "html",
					success: function(data){
						//$(this).closest('p.loading').remove();
						$('a.selected[data-action="expend-folder-tree"]').next('ul.folders').remove();
						$('a.selected[data-action="expend-folder-tree"]').after(data);
						$('a.selected[data-action="expend-folder-tree"]').next().fadeIn('slow');
					}
				});
				

			});



		});
	</script>
@stop
