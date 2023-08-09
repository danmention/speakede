
<?php

use App\Models\User;

function hos(){
    return ' blesing ';
}
function loaduser($id){

$user =   User::where('id', $id)->get();
return $user;

}