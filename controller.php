<?php
class Controller extends BaseController
{
    public function send($code,$data=null){
        $codes = [
            'REQUEST_SUCCESS'=>1000,
            'SERVER_ERROR'=>1003,
            'INVALID_PARAMS'=>1002,
            'TOKEN_AUTH_FAILE'=>1004,
            'TOKEN_EXPIRED'=>1005,
            'NOT_BIND_PHONE'=>1001
        ];
        if ($code == 1000) {
            if (!is_null($data)) {
                $responseData = ['code'=>1000,'data'=>$data,'msg'=>'success'];  
                return $this->response($responseData);
            } else {
                $responseData = ['code'=>1000,'msg'=>'success'];
                return $this->response($responseData);
            }
        }
        if ($code == 1001) {
            return $this->response(['code'=>1001,'msg'=>'没有绑定手机号']);
        }
        if ($code == 1002) {
            if (is_null($data)) {
                $data = '参数验证不通过';
            }
            $responseData = ['code'=>1002,'msg'=>$data];
            return $this->response($responseData);
        }
        if ($code == 1003) {
            $responseData = ['code'=>1003,'msg'=>'服务器错误'];
            return $this->response($responseData);
        }
        if ($code == 1004) {
            $responseData = ['code'=>1004,'msg'=>'token令牌认证失败'];
            return $this->response($responseData);
        }
        if ($code == 1005) {
            $responseData = ['code'=>1005,'msg'=>'token令牌过期'];
            return $this->response($responseData);
        }
        if ($code == 1006) {
            $responseData = ['code'=>1006,'msg'=>'余额不足'];
            return $this->response($responseData);
        }
    }
    public function response($data){
        return response()->json($data)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Access-Control-Allow-Methods','GET,POST,OPTIONS,PUT,DELETE')
                ->header('Access-Control-Allow-Headers','X-Requested-With,Origin, Content-Type')
                ->header('Content-Type','application/json;charset=utf-8');
    }
   

}
