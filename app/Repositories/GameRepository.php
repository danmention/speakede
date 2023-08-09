<?php

namespace App\Repositories;

use App\Models\GameHistory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Redirect;

class GameRepository {

    public static $Paid                 = 1;
    public static $NotPaid              = 2;
    public static $merged               = 3;
    public static $NotMerged            = 4;
    public static $activeGamer          = 5;
    public static $notActiveGamer       = 6;
    public static $outOfTheTournament   = 7;
    public static $waitingToPlayTheGame = 8;
    public static $PlayingTheGame       = 9;

    public static $firstLevelApproval   = 10;
    public static $secondLevelApproval  = 11;
    public static $winner  = 12;


    public static function generateIds($type)
    {
        $mt = explode(' ', microtime());
        $rand = time() . rand(10, 99);
        $time = ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
        $generated = $rand . $time;

        switch ($type) {
            case "payment" :
                return "3060" . $generated;
                break;
            case "game" :
                return "3061" . $generated;
                break;
            default:
                return "3069" . $generated;
                break;
        }
    }


    public static function ExistingMergedPartner($user_id,$level, $tournaments_id){

        $checker = GameHistory::where('partner_id',0)->where('merge_status',GameRepository::$NotMerged)
        ->where('game_level',$level)->get();

        if ($checker->count() > 0) {
            $new_partner = User::where('status',  GameRepository::$waitingToPlayTheGame)
           ->where('tournaments_id', $tournaments_id)->where('game_level', $level)
           ->where('id', '=', $user_id)->take(1)->get();


            if ($new_partner->count() > 0) {
               $checker2 = GameHistory::where('partner_id',0)->where('merge_status',GameRepository::$NotMerged)->where('game_level',$level)->take(1)->get();
            /* MERGING WITH PARTNER*/
                $update_process_map = GameHistory::find($checker2[0]->id);
                $update_process_map->partner_id = $new_partner[0]->id;
                $update_process_map->merge_status = GameRepository::$merged;
                $update_process_map->game_level = $level;

                $update_process_map->save();
                /* END MERGING WITH PARTNER*/

                /* UPDATING USER LEVEL TO 1 BLC THIS PART IS SUCCESSFUL */

                /* GETTING FIRST USER */
                $updateusers = User::find($checker2[0]->user_id);
                $updateusers->game_level = $level;
                $updateusers->status = GameRepository::$PlayingTheGame;
                $updateusers->save();
                /* END OF GETTING FIRST USER */

                /* GETTING SECOND USER */
                $updateusers2 = User::find($new_partner[0]->id);
                $updateusers2->game_level = $level;
                $updateusers2->status = GameRepository::$PlayingTheGame;
                $updateusers2->save();
                /* END OF GETTING SECOND USER */
            }else {
                return Redirect()->back()->with('response', "no partner right now");
            }
        }else {

            self::CreatingNewGamePartner($user_id,$level,$tournaments_id);
        }
    }


    public static function CreatingNewGamePartner($user_id,$level, $tournaments_id){


        if($level > 1){

            $checker = GameHistory::where('partner_id',0)->where('merge_status',GameRepository::$NotMerged)->where('game_level',$level)->get();

            if ($checker->count() > 0) {
                self::ExistingMergedPartner($user_id, $level,$tournaments_id);
            }else {

                $game_history = GameHistory::where('user_id', $user_id)->orWhere('partner_id', $user_id)->where('game_level',$level)
            ->where('tournaments_id',$tournaments_id)->get();


            if($game_history->count() > 0){
                foreach($game_history as $row){
                    if(!empty($row->user_result)){
                        $create_new_game_history = 0;
                    }else {
                        $create_new_game_history = 1;
                    }
                }
            }else {
                return Redirect()->back()->with('response', "no partner right now");
            }

            }



        } else {

            $checker = GameHistory::where('partner_id',0)->where('merge_status',GameRepository::$NotMerged)->where('game_level',$level)->get();

            if ($checker->count() > 0) {
                self::ExistingMergedPartner($user_id, $level,$tournaments_id);
            }

            $create_new_game_history = GameHistory::where('user_id', $user_id)->orWhere('partner_id', $user_id)->where('game_level',$level)->count();



        }


        if ($create_new_game_history == 0) {
            $process_map                    = new GameHistory();
            $process_map->user_id           = $user_id;
            $process_map->merge_status       = GameRepository::$NotMerged;
            $process_map->partner_id        = 0;
            $process_map->tournaments_id    = $tournaments_id;
            $process_map->game_level        = $level;
            $process_map->status            = GameRepository::$firstLevelApproval;
            $process_map->save();
            /* GRABING THE GAME HISTORY ID */
            $game_history_id                = $process_map->id;
            /* END OF GRABING THE GAME HISTORY ID */

            /* END OF ADDING RECORD TO GAME HISTORY BLC THE USER HAS PAID FOR IT */

            /* GETTING A PARTNER */
            $new_partner = User::where('status', GameRepository::$waitingToPlayTheGame)
            ->where('tournaments_id', $tournaments_id)->where('game_level', $level)
            ->where('id', '!=', $user_id)->take(1)->get();

            if ($new_partner->count() > 0) {
                /* MERGING WITH PARTNER*/
                $update_process_map = GameHistory::find($game_history_id);
                $update_process_map->partner_id = $new_partner[0]->id;
                $update_process_map->merge_status = GameRepository::$merged;
                $update_process_map->game_level = $level;

                $update_process_map->save();
                /* END MERGING WITH PARTNER*/

                /* UPDATING USER LEVEL TO 1 BLC THIS PART IS SUCCESSFUL */

                /* GETTING FIRST USER */
                $updateusers = User::find($user_id);
                $updateusers->game_level = $level;
                $updateusers->status = GameRepository::$PlayingTheGame;
                $updateusers->save();
                /* END OF GETTING FIRST USER */

                /* GETTING SECOND USER */
                $updateusers2 = User::find($new_partner[0]->id);
                $updateusers2->game_level = $level;
                $updateusers2->status = GameRepository::$PlayingTheGame;
                $updateusers2->save();
            /* END OF GETTING SECOND USER */
            } else {
                return back()->with('message', 'no partner now, come back latter');
            }
        }
    }

    /*  */

    public static function Initiate($user_id, $user_level,$tournaments_id){

           if($user_level > 1){
               $if_not_merged = User::where('status', self::$waitingToPlayTheGame)->where("id",  $user_id)
               ->where('game_level', $user_level)->where('tournaments_id', $tournaments_id)->get();

               if($if_not_merged->count() > 0){
                   self::ExistingMergedPartner($user_id,$user_level, $tournaments_id);
               }else{

               }
           }

    }



}
