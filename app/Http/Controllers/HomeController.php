<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function coba(){
        $dataarray = ["A","B","C","D","E"];

        /*
         * menghitung jumlah data di array
         */
        $jml = sizeof($dataarray);
        $k = 5;

        /*
         * menampung data hasil penggabungan
         */
        $data = array();

        /*
         * melakukan perulangan sesuai dengan jumlah array
         * berfungsi untuk mendapatkan smua data yang ada dalam array
         */
        for($i=0;$i<$jml;$i++){

            /*
             * Data awal dari penggabungan
             * ketika $dataarray[0] maka akan mendapatkan data A
             * ketika $dataarray[1] maka akan mendapatkan data B
             */
            $a=$dataarray[$i];

            /*
             * Ketika k=1 maka akan menampilkan data asli yang berada dalam array
             */
            if($k>1){

                /*
                 * Perulangan dilakukan guna menggabungkan data sesuai jumlah k
                 */
                for($j=1;$j<$k;$j++){

                    /*
                     * menghentikan perulangan yang ke dua
                     */
                    if($i==($jml-($k-1))){
                        break;
                    }
                    
                    /*
                     * Menggabungkan data
                     */
                    $a.=$dataarray[$i+$j];
                }

                /*
                 * Menghentikan perulangan yang pertama
                 */
                if($i==($jml-($k-1))){
                    break;
                }
            }
            
            /*
             * Memasukan data hasil dari penggabungan data ke dalam array baru 
             */
            array_push($data, $a);
        }

        /*
         * menampilkan data
         */
        print_r($data);
    }

    public function acakNomorUndian(){
        try{
            $undian = \DB::table('undian')->get();
            
            $collection = collect($undian);
            $noUndianNotAvailable = $collection->pluck('nomor')->all();

            $noUndianAvailable = array();
            for($i=1;$i<=1000000;$i++){
                if(!in_array($i, $noUndianNotAvailable)){
                    array_push($noUndianAvailable, $i);
                }
            }

            if(empty($noUndianAvailable)){
                $noundian = "Nomor undian tidak tersedia";
            }else{
                $collection = collect($noUndianAvailable);
                $noundian = $collection->random();
                
                \DB::table('undian')->insert([
                    'nomor' => $noundian,
                    'nama'  => str_random(10)
                ]);
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return $noundian;
    }

    public function acak(){
        try{
            for($i=1;$i<20;$i++){
                $this->acakNomorUndian();
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return "berhasil";
    }
}
