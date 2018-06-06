<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 16:58
 */

namespace app\modules\mch\models;


class CopyForm extends Model
{
    public $url;
    public $level = 2;

    public function rules()
    {
        return [
            [['url'], 'trim'],
            [['url'], 'string']
        ];
    }

    public function copy()
    {
        if (!$this->validate())
            return $this->getModelError();
        $arr = explode('?', $this->url);
        if (count($arr) < 2) {
            return [
                'code' => 1,
                'msg' => '链接错误，请检查链接'
            ];
        }

        if (strpos($arr[0], 'taobao') || strpos($arr[0], 'tmall')) {
//            $id = 550718798356;
//            $id = $this->preg_substr('/&?id=/', '/&/', $arr[1]);
            $id = $this->preg_substr('/(\?id=|&id=)/', '/&/', $this->url);
            $data = $this->t_copy($id[0]);
            if($data['code'] == 1){
                return $data;
            }
            return [
                'code' => 0,
                'msg' => 'success',
                'data' => $data
            ];
        }
        return [
            'code' => 1,
            'msg' => '链接错误，请检查链接'
        ];
    }

    /**
     * @param $id
     * @return array
     * 淘宝&&天猫抓取
     */
    public function t_copy($id)
    {
        $url_tianmao = "http://hws.m.taobao.com/cache/wdetail/5.0/?id=" . $id;
//        $url_tianmao = "http://hws.m.taobao.com/cache/wdetail/5.0/?id=550718798356";
        try {
            $html = $this->getHTTPS($url_tianmao);
        } catch (\Exception $e) {
            try {
                $html = $this->normal_curl($url_tianmao);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                exit();
            }
        }
        $coding = mb_detect_encoding($html, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'ISO-8859-1'));
        $html = mb_convert_encoding($html, 'utf-8', $coding);
        $content_ori = strip_tags($html);
        $content_arr = json_decode($content_ori, true);
        if ($content_arr['ret'][0] != 'SUCCESS::调用成功') {
            return [
                'code' => 1,
                'msg' => '宝贝不存在，请检查输入链接'
            ];
        }
        $info = $content_arr['data']['itemInfoModel'];
        //标题
        $title = $info['title'];
        //缩略图
        $picsPath = $info['picsPath'];

        $pro_detail = json_decode($content_arr['data']['apiStack']['0']['value'], true);
        $pro_data = $pro_detail['data'];
        $pro_detail_info = $pro_data['itemInfoModel'];
        //商品价格
        $price = isset($pro_detail_info['priceUnits'][1]) ? $pro_detail_info['priceUnits'][1]['price'] : $pro_detail_info['priceUnits'][0]['price'];
        $price_arr = explode('-',$price);
        $goods_price = $price_arr[0];//原价
        $sale_price = $pro_detail_info['priceUnits'][0]['price'];
        $sale_price_arr = explode('-',$sale_price);
        $goods_price_sale = $sale_price_arr[0];//售价
        //销量
        $sale_count = $pro_detail_info['totalSoldQuantity'];
        //库存
        $quantity = $pro_detail_info['quantity'];

        $cat_model = $content_arr['data']['skuModel'];
        $quantity_model = $pro_data['skuModel'];
        $quantity_list = [];
        if (isset($quantity_model['skus'])) {
            $quantity_list = $quantity_model['skus'];
        }
        //规格列表
        $attr_group_list = [];
        //规格库存列表
        $checked_attr_list = [];

        if (isset($cat_model['skuProps'])) {
            foreach ($cat_model['skuProps'] as $index => $value) {
                if ($index > $this->level) {
                    break;
                }
                $attr_group_list[$index]['attr_group_name'] = $value['propName'];
                $attr_group_list[$index]['attr_list'] = [];
                foreach ($value['values'] as $key => $item) {
                    $attr_group_list[$index]['attr_list'][$key]['attr_name'] = $item['name'];
                    $attr_group_list[$index]['attr_list'][$key]['imgUrl'] = isset($item['imgUrl']) ? $item['imgUrl'] : "";
                }
            }
            $ppathIdmap = $cat_model['ppathIdmap'];
            $data = $quantity_list;
//            $data = $pro_data['skuModel']['skus'];
            $checked_attr_list = $this->get_attr_list($cat_model['skuProps'], 0);
            foreach ($checked_attr_list as $index => $value) {
                try {
                    $dd = $data[$ppathIdmap[$value['dataId']]];
                    $num = $dd['quantity'];
                    $price = $dd['priceUnits'][0]['price'];
                } catch (\Exception $e) {
                    $num = 0;
                    $price = 0;
                }
                if ($num) {
                    $checked_attr_list[$index]['num'] = $num;
                    $checked_attr_list[$index]['price'] = $price;
                } else {
                    $checked_attr_list[$index]['num'] = 0;
                    $checked_attr_list[$index]['price'] = 0;
                }
            }

        }
        //图文详情
        $detail_info = "";
        if (isset($content_arr['data']['descInfo'])) {
            $detail_info = $this->detail_info($content_arr['data']['descInfo']['fullDescUrl']);
        }
//        VarDumper::dump($checked_attr_list,6,1);
//        VarDumper::dump($pro_detail['data'], 9, 1);
//        VarDumper::dump($content_arr['data']['skuModel'], 6, 1);
//        exit();
        return [
            'title' => $title,//标题
            'picsPath' => $picsPath,//缩略图
            'price' => $goods_price,//原价
            'sale_price' => $goods_price_sale,//原价
            'sale_count' => $sale_count,//销量
            'quantity' => $quantity,//库存
            'attr_group_list' => $attr_group_list,//规格列表
            'checked_attr_list' => $checked_attr_list,//规格库存列表
            'detail_info' => $detail_info//图文详情
        ];
    }

    /**
     * @param $list   //规格列表
     * @param $level  //规格列表下标
     * @param array $attr_list
     * @param string $n
     * @param array $new_list
     * @return array
     * 规格列表数组重组
     */
    public function get_attr_list($list, $level, $attr_list = array(), $n = '', $new_list = array())
    {
        foreach ($list[$level]['values'] as $key => $item) {
            $attr_list_new = $attr_list;
            $n_n = $n;
            $a = [];
            $n_n .= $list[$level]['propId'] . ':' . $item['valueId'];
            $a['attr_group_name'] = $list[$level]['propName'];
            $a['attr_id'] = null;
            $a['attr_name'] = $item['name'];
            array_push($attr_list_new, $a);
            if ($level < count($list) - 1 && $level < $this->level) {
                $new_list = $this->get_attr_list($list, $level + 1, $attr_list_new, $n_n . ';', $new_list);
            } else {
                $new_list_new['attr_list'] = $attr_list_new;
                $new_list_new['dataId'] = $n_n;
                $new_list[] = $new_list_new;
            }
        }
        return $new_list;
    }

    /**
     * 图文详情
     */
    public function detail_info($url)
    {
        try {
            $html = $this->getHTTPS($url);
        } catch (\Exception $e) {
            try {
                $html = $this->normal_curl($url);
            } catch (\Exception $e) {
                \Yii::warning('图文详情出错');
                return "";
//                var_dump($e->getMessage());
//                exit();
            }
        }
        $coding = mb_detect_encoding($html, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5', 'ISO-8859-1'));
        $html = mb_convert_encoding($html, 'utf-8', $coding);
//        $content_ori = strip_tags($html);
        $content_arr = json_decode($html, true);
        try {
            $info = $this->preg_substr('/<body>[^>]*>/', '/<\/body>/', $content_arr['data']['desc']);
        } catch (\Exception $e) {
            \Yii::warning('图文详情错误：' . $e->getMessage());
            $info[0] = '';
        }
        return $info[0];
    }

    /**
     * @param $start
     * @param $end
     * @param $str
     * @return array
     * 正则截取函数
     */
    public function preg_substr($start, $end, $str) // 正则截取函数
    {
        try {
            $temp = preg_split($start, $str);
        } catch (\Exception $e) {
            var_dump($str);
            exit();
        }
        $result = [];
        foreach ($temp as $index => $value) {
            if ($index == 0) continue;
            $content = preg_split($end, $value);
            array_push($result, $content[0]);
        }
        return $result;
    }

    /**
     * @param $start
     * @param $end
     * @param $str
     * @return array
     * 字符串截取函数
     */
    function str_substr($start, $end, $str) // 字符串截取函数
    {
        $temp = explode($start, $str);
        try {
            $result = [];
            foreach ($temp as $index => $value) {
                if ($index == 0) continue;
                $content = explode($end, $value);
                array_push($result, $content[0]);
            }
            return $result;
        } catch (\Exception $e) {
            var_dump($temp);
            return [];
        }
    }

    /**
     * @param $url
     * @return mixed
     * curl访问https
     */
    public function getHTTPS($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param $url
     * @return mixed
     * curl访问http
     */
    public function normal_curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        //错误提示
        if (curl_exec($curl) === false) {
            die(curl_error($curl));
        }
        // 检查是否有错误发生
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);
        return $data;
    }
}