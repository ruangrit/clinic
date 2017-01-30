<?php
vc_map(
    array(
        "name"     => esc_html__("Bravo Instagram", "medicool"),
        "base"     => "bravo_instagram",
        "category" => "CMSBlueTheme",
        'params' => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => esc_html__('Title', "medicool"),
                'param_name' => 'title',
                'suffix'=>esc_html__('Title',"medicool"),
            ),

            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => esc_html__('Access Token',"medicool"),
                'param_name' => 'accesstoken',
                'description' => esc_html__('login Instagram and visit here http://instagram.pixelunion.net Get Your Instagram Instagram Access Token','medicool'),
            ),

            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => esc_html__('Number Photos', "medicool"),
                'param_name' => 'num_photo',
                'suffix'=>esc_html__('Photos',"medicool"),
                'min'=>'0',
            ),


        )
    )
);
bravo_reg_shortcode('bravo_instagram', 'bravo_instagram_func');
if (!function_exists('bravo_instagram_func')) {
    function bravo_instagram_func($attr, $content = false)
    {
        $html =  $user_name = $accesstoken = $num_photo = '';

        extract(shortcode_atts(array(
            'title' => '',
            'accesstoken' => '',
            'num_photo' => '',
        ), $attr));


        $access_token = ($accesstoken != '') ? $accesstoken : '2293191191.1677ed0.9efbd57189724cf282e4a56a103348bd'; // put your access token here
        $insta = new Bravo_InstaWCD();
        $insta->access_token = $access_token;
        $insta->count = $num_photo;

        $ins_media = $insta->userMedia();
        if(isset($ins_media['data'])) {
            if (is_array($ins_media['data']) && count($ins_media['data']) > 0) {
                $html .= '
                            <div class="widget wg-instagram">
                                    <h3>'.esc_html($title).'</h3>
                                    <ul class="notype list-member-ins">';
                                        foreach ($ins_media['data'] as $vm):
                                            $img = $vm['images']['thumbnail']['url'];
                                            $link = $vm["link"];
                                            $html .= ' <li><a href="'. esc_url($link) .'" target="_blank"><img style=" width: 80px;  height: 90px; " src="' . esc_url($img) . '" alt=""></a> </li> ';
                                        endforeach;
                $html .= ' </ul>
                       </div>';
            }
        }

        return $html;
    }
}
//Class ST_bravo_medical_InstaWCD
if (!class_exists('Bravo_InstaWCD')) {
    class Bravo_InstaWCD
    {
        function userID()
        {

            $token = $this->access_token;
            $count = $this->count;
            $url = "https://api.instagram.com/v1/users/self/?access_token=" . $token;
            $get = wp_remote_fopen($url);
            $json = json_decode($get);
            if(!empty($json->data) and count($json->data) > 0) {
                return $json->data->id;
            }else{
                return '00000000'; // return this if nothing is found
            }

        }
        function userMedia()
        {
            $url = 'https://api.instagram.com/v1/users/' . esc_attr( $this->userID()) . '/media/recent/?count='.esc_attr($this->count).'&access_token='. esc_html($this->access_token);

            $content = wp_remote_fopen($url);
            return $json = json_decode($content, true);
        }

    }
}


