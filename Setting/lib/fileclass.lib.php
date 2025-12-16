<?
/*
	파일 관련 클래스
*/
class FILE_CLASS
{
	//ThumNail (gd 2.x 버전)
	function createThum($src,$dest,$maxWidth,$maxHeight,$quality=100)
	{
		if (file_exists($src)  && isset($dest))
		{
			// path info
			$destInfo  = pathInfo($dest);
			// image src size
			$srcSize  = getImageSize($src);
			// image dest size $destSize[0] = width, $destSize[1] = height
			$srcRatio  = $srcSize[0]/$srcSize[1]; // width/height ratio
			$destRatio = $maxWidth/$maxHeight;
			if ($destRatio > $srcRatio)
			{
				$destSize[1] = $maxHeight;
				$destSize[0] = $maxHeight*$srcRatio;
			}
			else
			{
				$destSize[0] = $maxWidth;
				$destSize[1] = $maxWidth/$srcRatio;
			}

			// path rectification
			if ($destInfo['extension'] == "gif")
			{
				$dest = substr_replace($dest, 'jpg', -3);
			}

			// true color image, with anti-aliasing
			$destImage = imageCreateTrueColor($destSize[0],$destSize[1]);
			imageAntiAlias($destImage, true);

			// src image
			switch ($srcSize[2])
			{
				case 1: //GIF
					$srcImage = imageCreateFromGif($src);
					break;
				case 2: //JPEG
					$srcImage = imageCreateFromJpeg($src);
					break;
				case 3: //PNG
					$srcImage = imageCreateFromPng($src);
					break;
				default:
					return false;
					break;
			}

			// resampling
			imageCopyResampled($destImage, $srcImage, 0, 0, 0, 0,$destSize[0],$destSize[1],$srcSize[0],$srcSize[1]);

			// generating image
			switch ($srcSize[2])
			{
				case 1:
				case 2:
					imageJpeg($destImage,$dest,$quality);
					break;
				case 3:
					imagePng($destImage,$dest);
					break;
			}
			return  $dest;
		}
		else
		{
			return false;
		}
	}

	//파일 업로드
	function fileUp($file, $file_name, $savedir, $type=null)
	{
		if($file!= "none"&&!empty($file))
		{
			$pos = strrpos($file_name,".");
			$name = substr($file_name,0,$pos);
			$ext = strtolower(substr($file_name,$pos+1));
			unset($returnFilename);
			$file_name = preg_replace ("/[ #\&\+\-%@=\/\\\:;,\'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $file_name);
			$returnFileName[1]=$file_name;

			if($type=='image')
			{
				$LimitExt=";gif;jpg;jpeg;swf;GIF;JPG;JPEG;SWF;png;PNG;bmp;";
				if(!strpos($LimitExt,$ext))
				{
					$this->alertBack("GIF,JPG,JEPG,SWF 이외의 그림화일은 업로드 하실수 없습니다.");
					exit;
				}
			}else{
				/*
				$LimitExt=";php3;php;php4;inc;html;htm;ins;ph;js;PHP3;PHP;PHP4;INC;HTML;HTM;INS;PH;JS;";
				if(strpos($LimitExt,$ext))
				{
					$this->alertBack("올바른 형식의 파일이 아닙니다");
					exit;
				}
				*/
				$LimitExt=";gif;jpg;jpeg;png;bmp;zip;alz;doc;docx;xls;xlsx;txt;ppt;pptx;hwp;pdf;";
				if(!strpos($LimitExt,strtolower($ext)))
				{
					$this->alertBack("허용된 파일외에는 업로드 하실수 없습니다.");
					exit;
				}

			}

			$newfilename = $savedir.date("YmdHis",time()).".".$ext;
			$i = 1;
			while(file_exists("$newfilename"))
			{
				$newfilename = $savedir.date("YmdHis",time())."_".$i.".".$ext;
				$i++;
			}

			if(!is_dir($savedir)) $this->makeDir($savedir,"디렉토리생성을 실패하였습니다.");
			if(!copy($file,"$newfilename")) $this->alertBack("파일 업로드를 실패했습니다.");
			if(!unlink($file)) $this->alertBack("임시 파일을 삭제할 수 없습니다.");
			$returnFileName[0] = str_replace($savedir,"",$newfilename);
			return $returnFileName;

		}
	}
	# 파일이 저장되는 디렉토리를 생성한다.
	function makeDir($DIR,$STR=null)
	{
		 $MSG = str_replace("'","\'",$STR);
		 $mk_dir_result = mkdir($DIR,7777);
		 if(!$mk_dir_result)
		 {
		      $this -> alertBack("$MSG");
		 }
		 @chmod($DIR,7777);
	}

	//파일 삭제
	function fileDel($filepath)
	{
		if(file_exists($filepath)) unlink($filepath);
	}

	//파일 다운로드
	function fileDown($downloadname, $filepath)
	{

		$HTTP_USER_AGENT=$_SERVER["HTTP_USER_AGENT"];
		Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$filesize=filesize($filepath);
		if(strstr($HTTP_USER_AGENT, "MSIE 6."))
		{
			Header("Content-type: application/x-msdownload");
			Header("Content-Length: $filesize");
			Header("Content-Disposition: attachment; filename=$downloadname");
			Header("Content-Transfer-Encoding: binary");
			Header("Pragma: no-cache");
			Header("Expires: 0");
		}
		else if(strstr($HTTP_USER_AGENT, "MSIE 5.5"))
		{
			header("Content-Type: doesn/matter");
			header("Content-disposition: filename=$downloadname");
			header("Content-Transfer-Encoding: binary");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		else
		{
			Header("Content-type: file/unknown");
			header("Content-Disposition: attachment; filename=$downloadname");
			Header("Content-Description: PHP3 Generated Data");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		header("Content-Description: File Transfert");
		readfile($filepath);
		exit;
	}

	//파일 읽어서 문자열로 반환
	function fileRead($filepath)
	{
//		echo $filepath;
		if(file_exists($filepath)){
			if(!$fp = fopen("$filepath","r")) echo "file open error";
			$file_size = filesize($filepath);
			$text = fread($fp,$file_size);
			fclose($fp);
			return $text;
		}
		else return "";
	}

	// 이 클래스내에서 필요해서 적어뒀다. 여기를 제외하고는 func.lib.php에서 사용할것이다.
	function alertBack($msg)
	{
		echo "<script language=javascript>
		<!--
		alert(\"".$msg."\");
		history.back();
		//-->
		</script>";
		exit;
	}

	//텍스트 파일기록
	function textLogWrite($logfile,$str){
		if ( !file_exists($logfile)) touch($logfile);
		$rfile=fopen($logfile,'r');
		$txt = fread($rfile, filesize($logfile));
		$strWrite = $txt."\n";
		$strWrite .= $str;
		fclose($rfile);

		$out = fopen($logfile, "w");
		fwrite($out, $strWrite);
		fclose($out);
		//userpaging_cafechmod($logfile,0777);
	}
}

$phpopen="<"."?"."php";
$phpclose="?".">";
