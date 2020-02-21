<?php
namespace App;

use DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['first_name','last_name','address','birthday','email'];
    protected $protected = ['id','created_at','updated_at'];
    public function phones(){
        return $this->hasMany('App\Phone');
    }

    static public function getBirthdays(){
        $now = Carbon::now();
        return DB::table('contacts')->whereMonth('birthday', $now->month)->orderBy('birthday')->get();
    }
    static public function searchContacts($word){
        $contactExplode = explode(" ", $word, 2);
        return DB::table('contacts')
                     ->leftJoin('phones', 'phones.contact_id', '=', 'contacts.id' )
                     ->where('ddd', $contactExplode[0])
                     ->Where('number', $contactExplode[1])
                     ->orWhere(function($query) use ($contactExplode){
                        $query->where('first_name', $contactExplode[0])
                              ->where('last_name', $contactExplode[1]);
                        })
                     ->get();
    }

}
