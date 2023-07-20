<?php


namespace App\Helpers;


use App\Models\CustomerRating;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Double;

class CommonHelpers
{


    /**
     * @param $title
     * @param string $separator
     * @param string $language
     * @return string
     */
    public static function str_slug($title, string $separator = '-', string $language = 'en') : string
    {
        return Str::slug($title, $separator, $language);
    }

    /**
     * @param $string
     * @param $table
     * @param $field
     * @param $key
     * @param $value
     * @return array|string|string[]|null
     */
    public static function create_unique_slug($string, $table,$field,$key=NULL,$value=NULL): array|string|null
    {

        $slug = strtolower(self::str_slug($string));
        $i = 0;
        $params = array ();
        $params[$field] = $slug;
        if($key)$params["$key !="] = $value;

        while (DB::table($table)->where($params)->count()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params [$field] = $slug;
        }
        return $slug;

    }


    /**
     * @param $request
     * @return CustomerRating
     */
    public static function StoreReviews($request) : CustomerRating {

        $data = new CustomerRating();
        $data->fullname = $request->fullname;
        $data->email    = $request->email;
        $data->review   = $request->review;
        $data->user_id  = $request->identity ?? null;
        $data->rating   = $request->rating ?? 5;
        $data->save();


        // updating user table
        $numbers_of_rating =  CustomerRating::where('user_id',$request->identity)->sum('rating');
        $number_of_people_rating = CustomerRating::where('user_id',$request->identity)->count();

        $user_ids = User::where('identity',$request->identity)->value('id');
        $data_ = User::find($user_ids);

        if($number_of_people_rating == 0){
            $data_->rating = 0;
        }else {
            $final_rating = $numbers_of_rating / $number_of_people_rating;
            $data_->rating =  $data_->rating + $final_rating;
        }
        $data_->update();
        return $data;
    }

    /**
     * @param $type
     * @return string
     */
    public static function generateCramp($type) :string
    {
        $mt = explode(' ', microtime());
        $rand = time() . rand(10, 99);
        $time = ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
        $generated = $rand . $time;

        return match ($type) {
            "comments" => "3060" . $generated,
            "payment" => "3061" . $generated,
            "user" => "3062" . $generated,
            default => "3069" . $generated,
        };
    }

    /**
     * @param $user_id
     * @return float
     */
    public static function rating($user_id) : float {
        $numbers_of_rating =  CustomerRating::where('user_id',$user_id)->sum('rating');
        $number_of_people_rating = CustomerRating::where('user_id',$user_id)->count();

        if($number_of_people_rating == 0){
            $final_rating =  0;
        }else {
            $final_rating = $numbers_of_rating / $number_of_people_rating;
        }
        return $final_rating;
    }

    /**
     * @param $l
     * @param string $c
     * @return string
     */
    public static function code_ref ($l, string $c = '1234567890') : string {
        for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
        return $s;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function valid_email($email): bool
    {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $phone
     * @return bool
     */
    public static  function validate_phone_number($phone): bool
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }
    }

    public static function seoTemplate($type, $title_ = null) : array {

        $title = "ArtisanOga is an online blue-collar recruitment agency for companies in Nigeria.";
        $desc = "ArtisanOga connects local services such as cleaning, plumbing, electrical, carpentry, painting,
                            beauty, home appliances repairs, etc to homes and offices using the quickest technology with great customer experience.";
        $post_url = url('/');
        $post_image = asset('artisanOga.png');
        $listed = null;

        switch ($type){
            case "home" :
                $listed = ["title" => $title,"desc" => $desc, "post_url" => $post_url,"post_image" => $post_image];
                break;
            case "about-us":
                $desc_ ="At ArtisanOga we make it easy for businesses to hire bluecollar workers across Nigeria. Currently we have verified professionals in over 30 categories ranging from tailors, to beauticians, to plumbers, and tailors. Through the use of technology we unlock important career tools such as digital profiles, product galleries, customer reviews, and more.";
                $listed = ["title" => "ArtisanOga - ".ucwords($type),"desc" => $desc_, "post_url" => $post_url,"post_image" => $post_image];
                break;
            default:
                if(!empty($title_)){
                    $listed = ["title" => "ArtisanOga - ".ucwords($type), "desc" => $title_, "post_url" => $post_url,"post_image" => $post_image];
                }else {
                    $listed = ["title" => "ArtisanOga - ".ucwords($type), "desc" => $desc, "post_url" => $post_url,"post_image" => $post_image];
                }

        }
        return $listed;
    }


}
