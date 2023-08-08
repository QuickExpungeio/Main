<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myuploadlibrary {

	function __construct($data = NULL, $from_type = NULL)
    {
        // Get the CodeIgniter reference
        $this->_CI = &get_instance();
    }


	/*Upload Multiple Image Files*/
	function upload_multiple_images($files,$inputname,$uid,$uploadPath){

		$filesCount = count($files[$inputname]['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['file']['name']     = $files[$inputname]['name'][$i];
			$_FILES['file']['type']     = $files[$inputname]['type'][$i];
			$_FILES['file']['tmp_name'] = $files[$inputname]['tmp_name'][$i];
			$_FILES['file']['error']     = $files[$inputname]['error'][$i];
			$_FILES['file']['size']     = $files[$inputname]['size'][$i];

			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0777, true);
			}

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg",
				"gif"
			);
			$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

			if(in_array($file_extension, $allowed_image_extension)){

				if($_FILES['file']['size'] < 50000000){

					/*$tmp_name = $_FILES["file"]["tmp_name"];
					$name = time() . str_replace(array(' ','-'),'_',basename($_FILES["file"]["name"]));
					$uploadData[$i] = $uploadPath. $name;

					move_uploaded_file($tmp_name, $uploadPath. $name);*/

					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'png|jpg|jpeg|gif';
					$new_name = time().str_replace(array(' ','-'),'_',$_FILES['file']['name']);
					$config['file_name'] = $new_name;

					// Load and initialize upload library
					$this->_CI->load->library('upload', $config);
					$this->_CI->upload->initialize($config);

					// Upload file to server
					if($this->_CI->upload->do_upload('file')){
						// Uploaded file data
						$fileData = $this->_CI->upload->data();
						/*$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");*/

						$uploadData[$i] = $uploadPath. $new_name;
					}

				}else{
					$uploadData['error'] = "Allow Only 50MB File.";
				}
			}else{
				$uploadData['error'] = "Allow Only jpg,png,jpeg and gif file type.";
			}
		}

		return $uploadData;

	}
	/*Upload Multiple Image Files*/

	/*Upload Single Image Files*/
	function upload_single_image($files,$inputname,$uid,$uploadPath){

		$_FILES['file']['name']     = $files[$inputname]['name'];
		$_FILES['file']['type']     = $files[$inputname]['type'];
		$_FILES['file']['tmp_name'] = $files[$inputname]['tmp_name'];
		$_FILES['file']['error']     = $files[$inputname]['error'];
		$_FILES['file']['size']     = $files[$inputname]['size'];
		$uploadData="";
		//echo"<pre>";print_r($_FILES['file']);die;
		if (!is_dir($uploadPath)) {

			mkdir($uploadPath, 0777, true);
		}

		$allowed_image_extension = array(
			"png",
			"PNG",
			"jpg",
			"JPG",
			"jpeg",
			"JPEG",
			"gif",
			"pdf",
			"PDF",
			"docx",
			"doc",
			"xlsx",
			"xls",
			"txt"
		);
		$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

		if(in_array($file_extension, $allowed_image_extension)){

			if($_FILES['file']['size'] < 50000000){

				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png|jpg|jpeg|gif|PNG|pdf|PDF|docx|xlsx|xls|txt';
				$new_name = time().".".$file_extension;
				$config['file_name'] = $new_name;

				// Load and initialize upload library
				$this->_CI->load->library('upload', $config);
				$this->_CI->upload->initialize($config);

				// Upload file to server
				if($this->_CI->upload->do_upload('file')){
					// Uploaded file data
					$fileData = $this->_CI->upload->data();
					/*$uploadData[$i]['file_name'] = $fileData['file_name'];
					$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");*/

					$uploadData = $uploadPath."/".$new_name;
					//print_r($uploadData);die;
				}

			}else{
				$uploadData['error'] = "Allow Only 50MB File.";
			}
		}else{
			$uploadData['error'] = "Allow Only jpg,png,jpeg,gif and pdf file type.";
		}

		return $uploadData;
    }
	/*Upload Single Image Files*/

	/*Upload Multiple Video Files*/
	function upload_multiple_videos($files,$inputname,$uid,$uploadPath){
        //print_r($files);
		$uploadData = array();
		$filesCount = count($files[$inputname]['name']);
		//print_r($filesCount);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['file']['name']     = $files[$inputname]['name'][$i];
			$_FILES['file']['type']     = $files[$inputname]['type'][$i];
			$_FILES['file']['tmp_name'] = $files[$inputname]['tmp_name'][$i];
			$_FILES['file']['error']     = $files[$inputname]['error'][$i];
			$_FILES['file']['size']     = $files[$inputname]['size'][$i];

			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0777, true);
			}

			$allowed_video_extension = array(
				"mp4",
				"MOV",
				"mov",
				"webm",
				"mkv"
			);
			$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

			if(in_array($file_extension,$allowed_video_extension)){

				if($_FILES['file']['size'] < 50000000){

					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'mov|MOV|mp4|webm|mkv';
					$new_name = time().str_replace(array(' ','-'),'_',$_FILES['file']['name']);
					$config['file_name'] = $new_name;

					// Load and initialize upload library
					$this->_CI->load->library('upload', $config);
					$this->_CI->upload->initialize($config);

					// Upload file to server
					if($this->_CI->upload->do_upload('file')){
						// Uploaded file data
						$fileData = $this->_CI->upload->data();
						/*$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");*/

						$uploadData[$i] = $uploadPath. $new_name;
					}

				}else{
					$uploadData['error'] = "Allow Only 50MB File.";
				}

			}else{
				$uploadData['error'] = "Allow Only mov,MOV,mp4,webm,mkv file type.";
			}

	 }
	 //print_r($uploadData);
	 return $uploadData;
    }
	/*Upload Multiple Video Files*/

	/*Upload Single Video Files*/
	function upload_single_video($files,$inputname,$uid,$uploadPath)
    {
			$_FILES['file']['name']     = $files[$inputname]['name'];
			$_FILES['file']['type']     = $files[$inputname]['type'];
			$_FILES['file']['tmp_name'] = $files[$inputname]['tmp_name'];
			$_FILES['file']['error']     = $files[$inputname]['error'];
			$_FILES['file']['size']     = $files[$inputname]['size'];
			$uploadData=array();
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0777, true);
			}

			$allowed_video_extension = array(
				"mp4",
				"MOV",
				"mov",
				"webm",
				"mkv"
			);

			$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

			if(in_array($file_extension,$allowed_video_extension)){

				if($_FILES['file']['size'] < 50000000){

					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'mov|MOV|mp4|webm|mkv';
					$new_name = time().str_replace(array(' ','-'),'_',$_FILES['file']['name']);
					$config['file_name'] = $new_name;

					// Load and initialize upload library
					$this->_CI->load->library('upload', $config);
					$this->_CI->upload->initialize($config);

					// Upload file to server
					if($this->_CI->upload->do_upload('file')){
						// Uploaded file data
						$fileData = $this->_CI->upload->data();
						/*$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");*/

						$uploadData = $uploadPath. $new_name;
					}else{
						$uploadData['error'] = $this->_CI->upload->display_errors();
					}

				}else{
					$uploadData['error'] = "Allow Only 50MB File.";
				}

			}else{
				$uploadData['error'] = "Allow Only mov,MOV,mp4,webm,mkv file type.";
			}

			return $uploadData;
    }
	/*Upload Single Video Files*/


	function remove_media_image($post,$uploadPath){

        $media_name = $post['media_name'];
		$filename = $uploadPath. $media_name;
        //echo $filename;

		if(file_exists($filename)){
			//echo "yes";
			//exit;
			$removeData = unlink($filename);
        	return $removeData;
        }else{
        	$removeData['error']="Data not found!";
        	return $removeData;
        }
    }

    function remove_media_video($post,$uploadPath){

        $media_name = $post['media_name'];
        //print $media_name;
        $filename = $uploadPath . $media_name;
        //print $filename;
        if(file_exists($filename)){
        	$removeData = unlink($filename);
        	return $removeData;
        }else{
        	$removeData['error']="Data not found!";
        	return $removeData;
        }

    }


    function remove_media_video_thumbnail($post,$uploadPath,$uploadPath1){

        $media_name = $post['media_name'];
        $video_thumbnail = $post['video_thumbnail'];
        //print $media_name;
        $filename = $uploadPath . $media_name;
        $filename1 = $uploadPath1 . $video_thumbnail;
        //print $filename;
        if(file_exists($filename) || file_exists($filename1)){
        	$removeData = unlink($filename);
        	$removeData1 = unlink($filename1);
        	return $removeData;
        	return $removeData1;
        }else{
        	$removeData['error']="Data not found!";
        	return $removeData;
        }

    }


}