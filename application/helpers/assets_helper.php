<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***funtion de beug */
function debug($val){
    $content = '<pre>
                    '.print_r($val,true).'
                </pre>';
    echo $content;
}


 /**debut gestion des sessions */
 if(!function_exists("session")){
    /**
     * @param $var
     * @param null $value
     * @return mixed
     */
    function session($var, $value = null){
        if(is_string($var) && $value === null){
            return CI_Controller::get_instance()->session->userdata($var);
        }

        if(is_string($var) && $value !== null){
            CI_Controller::get_instance()->session->set_userdata($var, $value);
        }

        if(is_array($var)){
            CI_Controller::get_instance()->session->set_userdata($var);
        }
    }

    /**message flash debut */
	if(!function_exists("flash")){
	    /**
	     * @param array|string $data
	     * @param null $value
	     * @return mixed
	     */
	    function flash($data, $value = null){

	        if(!is_array($data) && $value){
	            CI_Controller::get_instance()->session->set_flashdata($data, $value);
	             return true;
	        }

	        if(is_array($data)){
	            CI_Controller::get_instance()->session->set_flashdata($data);
	            return true;
	        }


	        if(!is_array($data) && is_null($value)){
	            return CI_Controller::get_instance()->session->flashdata($data);
	        }

	    }
	}
	 /**message flash fin */


    /**unset session */
    if(!function_exists("un_sess")){
        /**
         * @param $var
         * @param null $value
         * @return mixed
         */
        function un_sess($var){
            return CI_Controller::get_instance()->session->unset_userdata($var);
        }
    }


    /**destroy session */
    if(!function_exists("destroy_sess")){
        /**
         * @param $var
         * @param null $value
         * @return mixed
         */
        function destroy_sess($var){
            return CI_Controller::get_instance()->session->sess_destroy($var);
        }
    }

    /** active link */
    if (! function_exists('active_link')) {
        function active_link($controller)
        {
            $CI = &get_instance();

            $class = $CI->router->fetch_class();

            return ($class == $controller) ? 'active' : '';
        }
    }

    
}
/**is not login */
 function not_login(){
    if(!session('client') && CI_Controller::get_instance()->router->{'class'} ==='index'){
        flash('warning','merci de te connecter');
        redirect('/');
    }    
}

/**is login now*/
 function is_login(){
    if(session('client') && CI_Controller::get_instance()->router->{'class'} ==='index' ){
        flash('warning','vous êtes connecter en ce moment');
        redirect('home');
    }
}