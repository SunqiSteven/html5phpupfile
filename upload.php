<?php
$UPLOAD_FILE_STORAGE_ROOT = __DIR__.'/upload';
$UPLOAD_FILE_MAX_SIZE = 2*1024*1024;
$UPLOAD_FILE_ALLOW_TYPES = ['image/jpg','image/jpeg','image/png'];

if (is_uploaded_file($_FILES['file']['tmp_name'])) {
     $type = $_FILES['file']['type'];
     $size = $_FILES['file']['size'];
     if(!in_array($type,$UPLOAD_FILE_ALLOW_TYPES)){
        echo json_encode(['success'=>false,'error'=>'文件类型不正确']);
        exit;
     }
     if ($size > $UPLOAD_FILE_MAX_SIZE) {
        echo json_encode(['success'=>false,'error'=>'文件过大,最大支持2M']);
        exit;
     }
     $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
     $storePath =$UPLOAD_FILE_STORAGE_ROOT.DIRECTORY_SEPARATOR.date('Y-m-d');
     if (!is_dir($storePath)) {
         mkdir($storePath,true);
     }
     $filename = md5(time().str_pad(mt_rand(0,99999),5,'0')).'.'.$ext;
     $destination = $storePath.DIRECTORY_SEPARATOR.$filename;
     $moveResult = move_uploaded_file($_FILES['file']['tmp_name'],$destination);
     if ($moveResult) {
        echo json_encode(['success'=>true,'data'=>['file_url'=>$destination]]);
     } else {
        echo json_encode(['success'=>false,'error'=>'服务器保存文件出错']);
     }
}
