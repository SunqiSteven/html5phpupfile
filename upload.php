<?php
//configuration
$UPLOAD_FILE_STORAGE_ROOT = __DIR__; //文件保存根目录
$UPLOAD_FILE_STORAGE_DIR = 'upload'; //保存所有上传文件的目录名
$UPLOAD_FILE_MAX_SIZE = 2*1024*1024;  //上传文件最大2M
$UPLOAD_FILE_ALLOW_TYPES = ['image/jpg','image/jpeg','image/png']; //允许文件类型

//统一出错处理
function errorResponse($errorMsg){
    echo json_encode(['success'=>false,'error'=>$errorMsg]);
}


if (!isset($_FILES['file'])) {
    errorResponse('未上传文件');
}
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];
    if(!in_array($type,$UPLOAD_FILE_ALLOW_TYPES)){
        errorResponse('文件类型不正确');
    }
    if ($size > $UPLOAD_FILE_MAX_SIZE) {
        errorResponse('文件过大，最大2M');
     }
    $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $filePath = $UPLOAD_FILE_STORAGE_DIR.'/'.date('Y-m-d');
    $storePath =$UPLOAD_FILE_STORAGE_ROOT.DIRECTORY_SEPARATOR.$filePath;
    if (!is_dir($storePath)) {
         mkdir($storePath,true);
    }
    $filename = md5(time().str_pad(mt_rand(0,99999),5,'0')).'.'.$ext;
    $destination = $storePath.DIRECTORY_SEPARATOR.$filename;
    $moveResult = move_uploaded_file($_FILES['file']['tmp_name'],$destination);
    if ($moveResult) {
        echo json_encode(['success'=>true,
            'data'=>['file_url'=>'/'.$filePath.'/'.$filename]]);
    } else {
        errorResponse('服务器保存文件出错');
    }
}
