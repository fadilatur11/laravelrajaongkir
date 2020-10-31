<?php

namespace App\Services\Api;

class RajaongkirService{

    static function daftarProvinsi($param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/".$param."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ".getenv('RAJAONGKIR_API_KEY').""
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $data = json_decode($response,TRUE);
            return $data['rajaongkir']['results'];
        }
    }

    static function SearchProvince($request)
    {
        $province = self::daftarProvinsi('province');
        foreach ($province as $value) {
            $data[] = $value['province'].'-'.$value['province_id'];
        }
        $input = preg_quote($request, '~'); // don't forget to quote input string!
        $result = preg_grep('~' . $input . '~', $data);
        // dd($result);
        if ($result != NULL) {
            foreach ($result as $getdata) {
                $array[] = [
                    'province_id' => str_replace("-","",substr($getdata,strpos($getdata,"-")))
                    ,'province' => substr($getdata,0,strpos($getdata,"-"))
                ];
            }

        }else{
            $array = $result;
        }
        return $array;
    }

    static function getCity()
    {
        $cities = self::daftarProvinsi('city');
        return $cities;
    }

    static function searchCity($request)
    {
        $cities = self::daftarProvinsi('city');
        foreach ($cities as $value) {
            $data[] = $value['city_id'].' '.$value['type'].' '.$value['province_id'].' '.$value['postal_code'].' '.str_replace(" ",",",$value['city_name']).' '.str_replace(" ",",",$value['province']);
        }
        $input = preg_quote($request, '~'); // don't forget to quote input string!
        $result = preg_grep('~' .$input. '~', $data);
        if ($result != NULL) {
            foreach ($result as $getdata) {
                $getdatacity = explode(" ",$getdata);
                $array[] = [
                    'city_id' => $getdatacity[0],
                    'province_id' => $getdatacity[2],
                    'province' => str_replace(","," ",$getdatacity[5]),
                    'type' => $getdatacity[1],
                    'city_name' => str_replace(","," ",$getdatacity[4]),
                    'postal_code' => $getdatacity[3]
                ];
            }
        }else{
            $array = $result;
        }
        return $array;
    }
}
?>