<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Validator, Input, Redirect ;


abstract class Controller extends BaseController {

	use DispatchesJobs, ValidatesRequests;
    
    var $is_public = true;
	public function __construct()
	{
		
		$this->middleware('ipblocked');
		
        $driver             = config('database.default');
        $database           = config('database.connections');
       
        $this->db           = $database[$driver]['database'];
        $this->dbuser       = $database[$driver]['username'];
        $this->dbpass       = $database[$driver]['password'];
        $this->dbhost       = $database[$driver]['host']; 


        if(\Auth::check() == true)
        {
        	
        	if(!\Session::get('gid'))
        	{

				\Session::put('uid', \Auth::user()->id);
				\Session::put('gid', \Auth::user()->group_id);
				\Session::put('eid', \Auth::user()->email);
				\Session::put('ll', \Auth::user()->last_login);
				\Session::put('fid', \Auth::user()->first_name.' '. \Auth::user()->last_name);  
				\Session::put('themes', 'sximo-light-blue');     		
        	}
            if(\Session::get('gid')==5){
                $obj_prop = \DB::table('tb_properties')->where('user_id', \Auth::user()->id)->orWhere('assigned_user_id', \Auth::user()->id)->first();
                if(!empty($obj_prop)){                    
                    \Session::put('prop_slug', $obj_prop->property_slug);
                }
            } 
        } 

        if(!\Session::get('themes'))
        {
        	\Session::put('themes', 'sximo');	
        }
        
         \App::setLocale(CNF_LANG);
		 if (defined('CNF_MULTILANG') && CNF_MULTILANG == 1) {

		    $lang = (\Session::get('lang') != "" ? \Session::get('lang') : CNF_LANG);
		    \App::setLocale($lang);
		}    
		$data = array(
				'last_activity'=> strtotime(Carbon::now())
			);
		\DB::table('tb_users')->where('id',\Session::get('uid'))->update($data);  
        
        $this->checkb2buser(); 
	}
    function getPackagesIdsAccordingMembershipiiiii(){
        $pakages_arr = array();
        $is_all = false;
        $upackages = array();
        if(isset(\Auth::user()->group_id)){
            $gid = (int) \Auth::user()->group_id;
            $travellerId = \CommonHelper::getusertype("users-b2c");
            if($gid != $travellerId){
                $is_all = true;
            }else
            {
                $order_pack_results = \DB::table('tb_orders')->select('tb_packages.id','tb_orders.status')
                                    ->join('tb_order_items','tb_order_items.order_id','=','tb_orders.id')
                                    ->join('tb_packages','tb_packages.id','=','tb_order_items.package_id')
                                    ->join('tb_packages_user_groups','tb_packages.id','=','tb_packages_user_groups.package_id')
                                    ->where('tb_packages_user_groups.group_id',$travellerId)->where('tb_orders.status','Success')
                                    ->groupBy('tb_packages.id')->get();
                if(!empty($order_pack_results)){
                    foreach($order_pack_results as $sii_package){
                        if(!in_array($sii_package->id,$pakages_arr)){ $pakages_arr[] = $sii_package->id; }
                    }
                }
            }
        }
        
        //get public packages
        /*if(count($pakages_arr) <= 0){
            if($is_all === true){
                $pakages_results = \DB::table('tb_packages')->select('id')->get();
            }else
            {
                $pakages_results = \DB::table('tb_packages')->select('id')->where('is_public',true)->get();
            }  
            if(!empty($pakages_results)){
                foreach($pakages_results as $si_package){
                    if(!in_array($si_package->id,$pakages_arr)){ $pakages_arr[] = $si_package->id; }
                }
            }
        }*/
        //End
        
        return $pakages_arr;
    }
    function getPackagesIdsAccordingMembership(){
        $pakages_arr = array();
        $is_all = false;
        $upackages = array();
        if(isset(\Auth::user()->group_id)){
            $gid = (int) \Auth::user()->group_id;
            $travellerId = \CommonHelper::getusertype("users-b2c");
            if($gid != $travellerId){
                $is_all = true;
            }else
            {
                $order_pack_results = \DB::table('tb_orders')->select('tb_packages.id','tb_orders.status')
                                    ->join('tb_order_items','tb_order_items.order_id','=','tb_orders.id')
                                    ->join('tb_packages','tb_packages.id','=','tb_order_items.package_id')
                                    ->join('tb_packages_user_groups','tb_packages.id','=','tb_packages_user_groups.package_id')
                                    ->where('tb_packages_user_groups.group_id',$travellerId)->where('tb_orders.status','Success')
                                    ->groupBy('tb_packages.id')->get();
                if(!empty($order_pack_results)){
                    foreach($order_pack_results as $sii_package){
                        if(!in_array($sii_package->id,$pakages_arr)){ $pakages_arr[] = $sii_package->id; }
                    }
                }
            }
        }
        
        //get public packages
        if(count($pakages_arr) <= 0){
            if($is_all === true){
                $pakages_results = \DB::table('tb_packages')->select('id')->get();
            }else
            {
                $pakages_results = \DB::table('tb_packages')->select('id')->where('is_public',true)->get();
            }  
            if(!empty($pakages_results)){
                foreach($pakages_results as $si_package){
                    if(!in_array($si_package->id,$pakages_arr)){ $pakages_arr[] = $si_package->id; }
                }
            }
        }
        //End
        
        return $pakages_arr;
    }

	function getComboselect( Request $request)
	{

		if($request->ajax() == true && \Auth::check() == true)
		{
			$param = explode(':',$request->input('filter'));
			$parent = (!is_null($request->input('parent')) ? $request->input('parent') : null);
			$limit = (!is_null($request->input('limit')) ? $request->input('limit') : null);
			$rows = $this->model->getComboselect($param,$limit,$parent);
			$items = array();
		
			$fields = explode("|",$param[2]);
			
			foreach($rows as $row) 
			{
				$value = "";
				foreach($fields as $item=>$val)
				{
					if($val != "") $value .= $row->$val." ";
				}
				$items[] = array($row->{$param['1']} , $value); 	
	
			}
			
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>" Ops .. Cant access the page !"));
		}	
	}

	public function getCombotable( Request $request)
	{
		if(Request::ajax() == true && Auth::check() == true)
		{				
			$rows = $this->model->getTableList($this->db);
			$items = array();
			foreach($rows as $row) $items[] = array($row , $row); 	
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>"  Ops .. Cant access the page !"));
		}				
	}		
	
	public function getCombotablefield( Request $request)
	{
		if($request->input('table') =='') return json_encode(array());	
		if(Request::ajax() == true && Auth::check() == true)
		{	

				
			$items = array();
			$table = $request->input('table');
			if($table !='')
			{
				$rows = $this->model->getTableField($request->input('table'));			
				foreach($rows as $row) 
					$items[] = array($row , $row); 				 	
			} 
			return json_encode($items);	
		} else {
			return json_encode(array('OMG'=>"  Ops .. Cant access the page !"));
		}					
	}

	function postMultisearch( Request $request)
	{
		$post = $_POST;
		$items ='';
		foreach($post as $item=>$val):
			if($_POST[$item] !='' and $item !='_token' and $item !='md' && $item !='id'):
				$items .= $item.':'.trim($val).'|';
			endif;	
		
		endforeach;
		
		return Redirect::to($this->module.'?search='.substr($items,0,strlen($items)-1).'&md='.Input::get('md'));
	}

	function buildSearch( )
	{
		$keywords = ''; $fields = '';	$param ='';
		$allowsearch = $this->info['config']['forms'];
		foreach($allowsearch as $as) $arr[$as['field']] = $as ;		
		if($_GET['search'] !='')
		{
			$type = explode("|",$_GET['search'] );
			if(count($type) >= 1)
			{
				foreach($type as $t)
				{
					$keys = explode(":",$t);
					if(in_array($keys[0],array_keys($arr))):
						if($arr[$keys[0]]['type'] == 'select' || $arr[$keys[0]]['type'] == 'radio' )
						{
							$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." ".self::searchOperation($keys[1])." '".$keys[2]."' ";	
						} else {
							$operate = self::searchOperation($keys[1]);
							if($operate == 'like')
							{
								$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." LIKE '%".$keys[2]."%%' ";		
							} else if( $operate =='is_null') {
								$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." IS NULL ";

							} else if( $operate =='not_null') {
								$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." IS NOT NULL ";

							} else if( $operate =='between') {
								$param .= " AND (".$arr[$keys[0]]['alias'].".".$keys[0]." BETWEEN '".$keys[2]."' AND '".$keys[3]."' ) ";								
							} else {
								$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." ".self::searchOperation($keys[1])." '".$keys[2]."' ";	
							}												
						}						
					endif;	
				}
			} 
		}		
		return $param;
	
	}

	function searchOperation( $operate)
	{
		$val = '';
		switch ($operate) {
			case 'equal':
				$val = '=' ;
				break;
			case 'bigger_equal':
				$val = '>=' ;
				break;
			case 'smaller_equal':
				$val = '<=' ;
				break;				
			case 'smaller':
				$val = '<' ;
				break;
			case 'bigger':
				$val = '>' ;
				break;
			case 'not_null':
				$val = 'not_null' ;
				break;								

			case 'is_null':
				$val = 'is_null' ;
				break;	

			case 'like':
				$val = 'like' ;
				break;	

			case 'between':
				$val = 'between' ;
				break;					

			default:
				$val = '=' ;
				break;
		}
		return $val;
	}		

	function inputLogs(Request $request, $note = NULL)
	{
		$data = array(
			'module'	=> $request->segment(1),
			'task'		=> $request->segment(2),
			'user_id'	=> Session::get('uid'),
			'ipaddress'	=> $request->getClientIp(),
			'note'		=> $note
		);
		\DB::table( 'tb_logs')->insert($data);		;
	
	}

	function validateForm()
	{
		$forms = $this->info['config']['forms'];
		$rules = array();
		foreach($forms as $form)
		{
			if($form['required']== '' || $form['required'] !='0')
			{
				$rules[$form['field']] = 'required';
			} elseif ($form['required'] == 'alpa'){
				$rules[$form['field']] = 'required|alpa';
			} elseif ($form['required'] == 'alpa_num'){
				$rules[$form['field']] = 'required|alpa_num';					
			} elseif ($form['required'] == 'alpa_dash'){
				$rules[$form['field']]='required|alpa_dash';																
			} elseif ($form['required'] == 'email'){
				$rules[$form['field']] ='required|email';
			} elseif ($form['required'] == 'numeric'){
				$rules[$form['field']] = 'required|numeric';		
			} elseif ($form['required'] == 'date'){
				$rules[$form['field']]='required|date';
			} else if($form['required'] == 'url'){
				$rules[$form['field']] = 'required|active_url';
			} else {
			
			}										
		}	
		return $rules ;
	}	

	function validatePost(  $table )
	{	
		$request = new Request;	
	///	return json_encode($_POST);	

		$str = $this->info['config']['forms'];
		$data = array();
		foreach($str as $f){
			$field = $f['field'];
			if($f['view'] ==1) 
			{
				

				if($f['type'] =='textarea_editor' || $f['type'] =='textarea')
				{
					$content = (isset($_POST[$field]) ? $_POST[$field] : '');
					 $data[$field] = $content;
				} else {

	
					if(isset($_POST[$field]))
					{
						$data[$field] = $_POST[$field];				
					}
					// if post is file or image		


					if($f['type'] =='file')
					{	

						$files ='';	
						if(isset($f['option']['image_multiple']) && $f['option']['image_multiple'] ==1)
						{
							
							if(isset($_POST['curr'.$field]))
							{
								$curr =  '';
								for($i=0; $i<count($_POST['curr'.$field]);$i++)
								{
									$files .= $_POST['curr'.$field][$i].',';
								}
							}	

							if(!is_null(Input::file($field)))
							{

								$destinationPath = '.'. $f['option']['path_to_upload']; 	
								foreach($_FILES[$field]['tmp_name'] as $key => $tmp_name ){
								 	$file_name = $_FILES[$field]['name'][$key];
									$file_tmp =$_FILES[$field]['tmp_name'][$key];
									if($file_name !='')
									{
										move_uploaded_file($file_tmp,$destinationPath.'/'.$file_name);
										$files .= $file_name.',';

									}
									
								}
								
								if($files !='')	$files = substr($files,0,strlen($files)-1);	
							}	
							$data[$field] = $files;
													

						} else {


		
							if(!is_null(Input::file($field)))
							{

								$file = Input::file($field); 
							 	$destinationPath = '.'. $f['option']['path_to_upload']; 
								$filename = $file->getClientOriginalName();
								$extension =$file->getClientOriginalExtension(); //if you need extension of the file
								$rand = rand(1000,100000000);
								$newfilename = strtotime(date('Y-m-d H:i:s')).'-'.$rand.'.'.$extension;
								$uploadSuccess = $file->move($destinationPath, $newfilename);
								 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
								 {
								 	if( $f['option']['resize_height'] ==0 )
									{
										$f['option']['resize_height']	= $f['option']['resize_width'];
									}
								 	$orgFile = $destinationPath.'/'.$newfilename;
									 \SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;						 
								 }
								 
								if( $uploadSuccess ) {
								   $data[$field] = $newfilename;
								} 
							} else {
								unset($data[$field]);
							}	
						}					
					}


					// if post is checkbox	
					if($f['type'] =='checkbox')
					{
						if(!is_null($_POST[$field]))
						{
							$data[$field] = implode(",",$_POST[$field]);
						}	
					}
					// if post is date						
					if($f['type'] =='date')
					{
						$data[$field] = date("Y-m-d",strtotime($request->input($field)));
					}
					
					// if post is seelct multiple						
					if($f['type'] =='select')
					{
						//echo '<pre>'; print_r( $_POST[$field] ); echo '</pre>'; 
						if( isset($f['option']['select_multiple']) &&  $f['option']['select_multiple'] ==1 )
						{
							$multival = (is_array($_POST[$field]) ? implode(",",$_POST[$field]) :  $_POST[$field]); 
							$data[$field] = $multival;
						} else {
							$data[$field] = $_POST[$field];
						}	
					}									
					
				}	 						

			}	
		}
		 $global	= (isset($this->access['is_global']) ? $this->access['is_global'] : 0 );
		
		if($global == 0 )
			$data['entry_by'] = \Session::get('uid');
					
		return $data;
	}

	function postFilter( Request $request)
	{
		$module = $this->module;
		$sort 	= (!is_null($request->input('sort')) ? $request->input('sort') : '');
		$order 	= (!is_null($request->input('order')) ? $request->input('order') : '');
		$rows 	= (!is_null($request->input('rows')) ? $request->input('rows') : '');
		$md 	= (!is_null($request->input('md')) ? $request->input('md') : '');
		
		$filter = '?';
		if($sort!='') $filter .= '&sort='.$sort; 
		if($order!='') $filter .= '&order='.$order; 
		if($rows!='') $filter .= '&rows='.$rows; 
		if($md !='') $filter .= '&md='.$md;
		 
		 

		return Redirect::to($this->data['pageModule'] . $filter);
	
	}	

	function injectPaginate()
	{

		$sort 	= (isset($_GET['sort']) 	? $_GET['sort'] : '');
		$order 	= (isset($_GET['order']) 	? $_GET['order'] : '');
		$rows 	= (isset($_GET['rows']) 	? $_GET['rows'] : '');
		$search 	= (isset($_GET['search']) ? $_GET['search'] : '');

		$appends = array();
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		
		return $appends;
			
	}	

	function returnUrl()
	{
		$pages 	= (isset($_GET['page']) ? $_GET['page'] : '');
		$sort 	= (isset($_GET['sort']) ? $_GET['sort'] : '');
		$order 	= (isset($_GET['order']) ? $_GET['order'] : '');
		$rows 	= (isset($_GET['rows']) ? $_GET['rows'] : '');
		$search 	= (isset($_GET['search']) ? $_GET['search'] : '');
		
		$appends = array();
		if($pages!='') 	$appends['page'] = $pages; 
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		
		$url = "";
		foreach($appends as $key=>$val)
		{
			$url .= "&$key=$val";
		}
		return $url;
			
	}	

	public function getRemovecurrentfiles( Request $request)
	{
		$id 	= $request->input('id');
		$field 	= $request->input('field');
		$file 	= $request->input('file');
		if(file_exists('./'.$file) && $file !='')
		{
			if(unlink('.'.$file))
			{
				\DB::table($this->info['table'])->where($this->info['key'],$id)->update(array($field=>''));
			}
			return Response::json(array('status'=>'success'));
		} else {
			return Response::json(array('status'=>'error'));
		}
	}	

	public function getSearch()
	{

		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		$this->data['pageUrl']		= url($this->module);
		return view('sximo.module.utility.search',$this->data);
	
	}

	function getDownload( Request $request)
	{
	
		if($this->access['is_excel'] ==0) 
			return Redirect::to('')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');   
	
		$info = $this->model->makeInfo( $this->module);
		// Take param master detail if any
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$params = array(
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		
		$results 	= $this->model->getRows( $params );
		$fields		= $info['config']['grid'];
		$rows		= $results['rows'];
		
		$content = $this->data['pageTitle'];
		$content .= '<table border="1">';
		$content .= '<tr>';
		foreach($fields as $f )
		{
			if($f['download'] =='1') $content .= '<th style="background:#f9f9f9;">'. $f['label'] . '</th>';
		}
		$content .= '</tr>';
		
		foreach ($rows as $row)
		{
			$content .= '<tr>';
			foreach($fields as $f )
			{
				if($f['download'] =='1'):
					$conn = (isset($f['conn']) ? $f['conn'] : array() );					
					$content .= '<td>'. \SiteHelpers::gridDisplay($row->$f['field'],$f['field'],$conn) . '</td>';
				endif;	
			}
			$content .= '</tr>';
		}
		$content .= '</table>';
		
		@header('Content-Type: application/ms-excel');
		@header('Content-Length: '.strlen($content));
		@header('Content-disposition: inline; filename="'.$title.' '.date("d/m/Y").'.xls"');
		
		echo $content;
		exit;
	
	}	


	function detailview( $model , $detail , $id )
	{
		
		$info = $model->makeInfo( $detail['module'] );
		$params = array(
			'params'	=> " And `".$detail['key']."` ='". $id ."'",
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$results = $model->getRows( $params );	
		$data['rowData']		= $results['rows'];
		$data['tableGrid'] 	= $info['config']['grid'];
		$data['tableForm'] 	= $info['config']['forms'];	
		
		return $data;

		
			
	}



	function detailviewsave( $model ,$request , $detail , $id )
	{
		
		\DB::table($detail['table'])->where($detail['key'],$request[$detail['key']])->delete();
		$info = $model->makeInfo( $detail['module'] );
		$str = $info['config']['forms'];
		$data = array($detail['master_key'] => $id );
		$total = count($request['counter']);
		for($i=0; $i<$total;$i++)
		{
			foreach($str as $f){
				$field = $f['field'];
				if($f['view'] ==1) 
				{
					//echo 'bulk_'.$field[$i]; echo '<br />';
					if(isset($request['bulk_'.$field][$i]))
					{
						$data[$f['field']] = $request['bulk_'.$field][$i];
					}
				}
				
			}	

			\DB::table($detail['table'])->insert($data);
		}	

		
	}
    public function checkb2buser(){
        $user_info = \DB::table('tb_users')->where('id',\Session::get('uid'))->first();
        if(\Auth::check()){ 
            $uid = \Auth::user()->id;
            
            if( \Auth::user()->i_agree == 0 ||  \Auth::user()->privacy_policy == 0 ||  \Auth::user()->cookie_policy == 0){
                  
            }elseif( \Auth::user()->new_user == 1){ 
                return Redirect::to('whoiam');
            }elseif( \Auth::user()->hotel_setup == 0){ 
                return Redirect::to('properties');
            }
            
        }
    }
    
    function getPackagesIdByMembership(){
        $pakages_arr = array();
        $is_all = false;
        $upackages = array();
         
        if(isset(\Auth::user()->group_id)){
            $gid = (int) \Auth::user()->group_id;
            $uid = (int) \Auth::user()->id;
            $travellerId = \CommonHelper::getusertype("users-b2c");
            if($gid != $travellerId){
                $is_all = true;
            }else
            {
                $order_pack_results = \DB::table('tb_orders')->select('tb_packages.id','tb_packages.package_title','tb_orders.status')
                                    ->join('tb_order_items','tb_order_items.order_id','=','tb_orders.id')
                                    ->join('tb_packages','tb_packages.id','=','tb_order_items.package_id')
                                    ->join('tb_packages_user_groups','tb_packages.id','=','tb_packages_user_groups.package_id')
                                    ->where('tb_packages_user_groups.group_id',$travellerId)->where('tb_orders.status','Success')
                                    ->where('tb_orders.user_id',$uid)
                                    ->groupBy('tb_packages.id')->get();
                if(!empty($order_pack_results)){
                    foreach($order_pack_results as $sii_package){
                        $ttl = str_replace(' ', '-', strtolower($sii_package->package_title));
                        if(!in_array($ttl,$pakages_arr)){ $pakages_arr[] = $ttl; }
                    }
                }
            }
        }
        return $pakages_arr;
    }
    
}

