<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use RSA;
class PayController extends Controller{
    //
    public function go_pay(){
//        dd(Input::post());die;
        $order_id = Input::get('order_id');
        $price = Input::get('price');
        $pri_key = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCHhWtG4PWu9mn/l5jainCiK3OnkUSLr68dqficur96Ajr3DyMGs7v6bG/GbPudNzREio9WMqYmbimvjtcx7H4dUy+g+B9qLTh90S3aOauW2EUs0t8NJ7KZA1/KiAMA4TngGTAyDREx4b1TOGOF3Ln2hlWXXRM7tMvR+B2hqAf/K3CdFAQO2Q8uiw9pnKHOfiZO642h5SIozTe77s0Gg85NSuaQ1G4CSAvxc2IIBQ/tofZtwLrRpa/j5SwgljekZw9J6kn/JpF/dVAofHhToabPyfecPX3ym2a1ek9Jpgm3mh8JfmYnUlkMRsxy4HeNe51dP1KwKnjGFt31Rb/XY5ZRAgMBAAECggEACdhWb8K99mTuVGQV9aJjBlTzxPOXsDImHZiQeApVCK8Ky5Hs8Hq0KEAiap7WNJijEmuieBeb3GTaYGeXGIherRCzABWmapc4aGN+2kCgR4gUlmoHTDRbFCSbm+H/ndu+0Zni12/9lMsabuZEzJ+5XsBpjWJ0mDzNJcbJmEnVsuLAWt7sjmo10JJH3dGm2HJ4byztEWuHTlHevMBVftafabagM88Ioi4Y1SvWf4OJifrI9bq1TMGWcgEj2Ac5iuKKwViR1FRekcsh9Zs/PeBUBQzInUGs+bUMDaO9mpDewHFdtZ58HT6rpWWBtVnztoM79eX2Bx9Alyze9FK+B+TucQKBgQDk5IS71RJ2WIpnURpnec12As1HY8jTH2bqvs36th9YbJsEYioqZe+jBskOjE5bUR8jQLgRDppeK/03s1ERT59Nr5irz18Ed39eZVv/WpoGu7oyeJUYZbfVNw5XD2VKXXR3w1ITOrWpotmnsDVc/Ai7Yjs5xO1iDYCK06byY/4k1QKBgQCXkhlXUR/loa3TsrGeEbqyQInNPbO9iuwvfUJA2ziERSCyrgi277QkIVBHXbVAOY5xSVW221q6G7nT/o21dirEPlqyFkge9GeFNtRJz0YBHP9+6ckTlX2vyIc30jxgAC7kyb0IrqBmtfymkcF3/u2B1Q72gGHUSrW4NXpTyc6ZjQKBgD0M1npi8nGuW/wCndBLpIl9ZdNMwhvNnF2wVrAwM1waW55nsGdumOQawzWmJqAkmvGEKZQjGPlVMkzQ/yZm3k6SL15kCSvf05ER59/MApkZKSidEOdY+hdcf+6opJOZKZ9n8VQ/rIR6cyNO1GzgrFOOd82IwOgOQeLFYRn1oauhAoGBAIXSAfmrsGPHuXc9P8B1msYiYQgKQBVLAHh1OPeWFXICrnnTWfJZ9Ewp9Xzs6UgJCRBQVRMa3CGQtSLMjkT2TY/yFZVCQu7Bjlx5Kjj4fbAh8BoXQua9h7iZbXkFbzS7NKveyb1OoGPOrYBLE+tj8kI83/cXJkiOpZ476QLtHDFJAoGAStKZT6IE26vY58HtbMmU3hAUraOI5WDqunj/vc+q43vAPSlhKHOJ7P4JDu7HpPJKWUxCs+X3lihdDc3SGCGNV6Ynfc4UyUZyqvse47M/zn+GngYFNhO7dBonet03aZOnTz9kh0LCJ3ZbuxUJnzcvdQtP/l501Z1GNSxDzgu0NZo=';
        $pub_key = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0/hl6rBbL5J3oqkfQrCZ+C3eoROrtv/yKlDQP/24NrpZ0w4iPyuUrWANGk5TszBvdGO4GCCq2aWJj1Qn6G0yuSZZIk/aL8YwSC81y8tjEYDKhTu3Zv6doQRXqcq/oLKJzwuKiVmlWu20Gg+fByb/MnQAmj7GuVXsdXPU5kX2Bb/OOmoj1OwgaNLHQs0rgf98V7V5STinH3/FXeN9UTUN+Jc86Fq0VbDcSPs4o0ePr+MbGXYqllUNbQGaKTUD7zfuOn78MwO9CCiKdHWHMvCZOiGS9z+rq+yy8BuLg+nlxej7taZAFJ10eZQKpigJzT8qgPELqLChTpykYdKtfG1D3QIDAQAB';

//        include './Rsa.php';

        //公共请求参数
        $arr = [
            'app_id' => '2018022702283497',
            'method' => 'alipay.trade.wap.pay',
            'return_url' => 'http://www.pengqq.xyz/alipay/return_url', //同步地址
            'charset' => 'utf-8',
            'sign_type' => 'RSA2',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0',
            'notify_url' => 'http://www.pengqq.xyz/alipay/notify_url',
            'biz_content' => '',
        ];

//业务请求参数
        $arr_params = [
            'subject'=>'测试',
            'out_trade_no'=> $order_id,
            'total_amount'=> 0.01,
            'product_code'=>'QUICK_WAP_WAY'
        ];

        $arr['biz_content'] = json_encode($arr_params,JSON_UNESCAPED_UNICODE);
//echo '<pre>';
        ksort($arr);
        $str =  urldecode(http_build_query($arr));

        $rsa = new RSA();

        $arr['sign'] =  $rsa->rsaSign($str, $pri_key);

//dd($arr);die;
//        return redirect('http://openapi.alipay.com/gateway.do?' . http_build_query($arr));
        header('location:https://openapi.alipay.com/gateway.do?' . http_build_query($arr));
    }

    public function notify_url(){
        $params = Input::all();
        $pub_key = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0/hl6rBbL5J3oqkfQrCZ+C3eoROrtv/yKlDQP/24NrpZ0w4iPyuUrWANGk5TszBvdGO4GCCq2aWJj1Qn6G0yuSZZIk/aL8YwSC81y8tjEYDKhTu3Zv6doQRXqcq/oLKJzwuKiVmlWu20Gg+fByb/MnQAmj7GuVXsdXPU5kX2Bb/OOmoj1OwgaNLHQs0rgf98V7V5STinH3/FXeN9UTUN+Jc86Fq0VbDcSPs4o0ePr+MbGXYqllUNbQGaKTUD7zfuOn78MwO9CCiKdHWHMvCZOiGS9z+rq+yy8BuLg+nlxej7taZAFJ10eZQKpigJzT8qgPELqLChTpykYdKtfG1D3QIDAQAB';
        $json = json_encode($params);
        file_put_contents('./alipay.txt' , $json. "\r\n" );
//        file_put_contents('./log.txt', print_r($params,true) . "\r\n",FILE_APPEND);
        $sign = $params['sign'];
        unset($params['sign']);
        unset($params['sign_type']);
        ksort($params);
        $str = urldecode(http_build_query($params));
        $rsa = new RSA();
        $stat = $rsa->rsaCheck($str , $pub_key , $sign);
        if ($stat){
            file_put_contents('./alipay.txt','签名验证通过'. "\r\n" ,FILE_APPEND);
            if ($params['trade_status'] == 'TRADE_SUCCESS' || $params['trade_status'] == 'TRADE_FINISHED'){
                file_put_contents('./alipay.txt','支付成功'. "\r\n" ,FILE_APPEND);
                $order_info = DB::table('ordercontent')->where('order_number',$params['out_trade_no'])->first();
                if ($params['total_amount'] == $order_info->price){
                    file_put_contents('./alipay.txt','判断金额成功'. "\r\n" ,FILE_APPEND);
                    $data['status'] = 2;
                    $order_data['status'] = 1;
                    DB::table('order')->where(['order_id'=>$params['out_trade_no'] , 'status'=>0])->update($order_data);
                    $res = DB::table('ordercontent')->where(['order_number'=>$params['out_trade_no'] , 'status'=>1])->update($data);
                    if ($res){
                        file_put_contents('./alipay.txt','修改订单状态成功'. "\r\n" ,FILE_APPEND);
                    } else {
                        file_put_contents('./alipay.txt','修改订单状态失败'. "\r\n" ,FILE_APPEND);
                    }
                }
            }
        } else {
            file_put_contents('./alipay.txt','签名验证不通过'. "\r\n" ,FILE_APPEND);
        }
    }

    public function return_url(){
        $arr = Input::all();
//        $json = json_encode($arr);
////        file_put_contents('./return.txt' , $json);
//        $order_info = DB::table('ordercontent')->where('order_number',$arr['out_trade_no'])->first();
//        if ($arr['total_amount'] == $order_info->price){
//            $content = "支付成功,请等待发货";
//        }
//
//        return view('return' , ['content'=>$content]);
        dd($arr);
    }

    public function refund(){
        $order_id = Input::get('order_id');
        $goods_id = Input::get('goods_id');
        $pri_key = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCHhWtG4PWu9mn/l5jainCiK3OnkUSLr68dqficur96Ajr3DyMGs7v6bG/GbPudNzREio9WMqYmbimvjtcx7H4dUy+g+B9qLTh90S3aOauW2EUs0t8NJ7KZA1/KiAMA4TngGTAyDREx4b1TOGOF3Ln2hlWXXRM7tMvR+B2hqAf/K3CdFAQO2Q8uiw9pnKHOfiZO642h5SIozTe77s0Gg85NSuaQ1G4CSAvxc2IIBQ/tofZtwLrRpa/j5SwgljekZw9J6kn/JpF/dVAofHhToabPyfecPX3ym2a1ek9Jpgm3mh8JfmYnUlkMRsxy4HeNe51dP1KwKnjGFt31Rb/XY5ZRAgMBAAECggEACdhWb8K99mTuVGQV9aJjBlTzxPOXsDImHZiQeApVCK8Ky5Hs8Hq0KEAiap7WNJijEmuieBeb3GTaYGeXGIherRCzABWmapc4aGN+2kCgR4gUlmoHTDRbFCSbm+H/ndu+0Zni12/9lMsabuZEzJ+5XsBpjWJ0mDzNJcbJmEnVsuLAWt7sjmo10JJH3dGm2HJ4byztEWuHTlHevMBVftafabagM88Ioi4Y1SvWf4OJifrI9bq1TMGWcgEj2Ac5iuKKwViR1FRekcsh9Zs/PeBUBQzInUGs+bUMDaO9mpDewHFdtZ58HT6rpWWBtVnztoM79eX2Bx9Alyze9FK+B+TucQKBgQDk5IS71RJ2WIpnURpnec12As1HY8jTH2bqvs36th9YbJsEYioqZe+jBskOjE5bUR8jQLgRDppeK/03s1ERT59Nr5irz18Ed39eZVv/WpoGu7oyeJUYZbfVNw5XD2VKXXR3w1ITOrWpotmnsDVc/Ai7Yjs5xO1iDYCK06byY/4k1QKBgQCXkhlXUR/loa3TsrGeEbqyQInNPbO9iuwvfUJA2ziERSCyrgi277QkIVBHXbVAOY5xSVW221q6G7nT/o21dirEPlqyFkge9GeFNtRJz0YBHP9+6ckTlX2vyIc30jxgAC7kyb0IrqBmtfymkcF3/u2B1Q72gGHUSrW4NXpTyc6ZjQKBgD0M1npi8nGuW/wCndBLpIl9ZdNMwhvNnF2wVrAwM1waW55nsGdumOQawzWmJqAkmvGEKZQjGPlVMkzQ/yZm3k6SL15kCSvf05ER59/MApkZKSidEOdY+hdcf+6opJOZKZ9n8VQ/rIR6cyNO1GzgrFOOd82IwOgOQeLFYRn1oauhAoGBAIXSAfmrsGPHuXc9P8B1msYiYQgKQBVLAHh1OPeWFXICrnnTWfJZ9Ewp9Xzs6UgJCRBQVRMa3CGQtSLMjkT2TY/yFZVCQu7Bjlx5Kjj4fbAh8BoXQua9h7iZbXkFbzS7NKveyb1OoGPOrYBLE+tj8kI83/cXJkiOpZ476QLtHDFJAoGAStKZT6IE26vY58HtbMmU3hAUraOI5WDqunj/vc+q43vAPSlhKHOJ7P4JDu7HpPJKWUxCs+X3lihdDc3SGCGNV6Ynfc4UyUZyqvse47M/zn+GngYFNhO7dBonet03aZOnTz9kh0LCJ3ZbuxUJnzcvdQtP/l501Z1GNSxDzgu0NZo=';

        $arr = [
            'app_id' => '2018022702283497',
            'method' => 'alipay.trade.refund',
            'charset' => 'utf-8',
            'sign_type' => 'RSA2',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0',
            'biz_content' => '',
        ];

        $arr_params = [
            'out_trade_no'=>    $order_id,
            'refund_amount'=>  0.01,
        ];

        $arr['biz_content'] = json_encode($arr_params,JSON_UNESCAPED_UNICODE);
//echo '<pre>';
        ksort($arr);
        $str =  urldecode(http_build_query($arr));

        $rsa = new RSA();

        $arr['sign'] =  $rsa->rsaSign($str, $pri_key);

//dd($arr);die;
//        return redirect('http://openapi.alipay.com/gateway.do?' . http_build_query($arr));
        header('location:https://openapi.alipay.com/gateway.do?' . http_build_query($arr));
    }
}
