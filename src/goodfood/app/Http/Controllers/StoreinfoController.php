<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreinfoController extends Controller
{
    public function __construct()
    {
        $this->
            middleware('auth');
    }
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index($id)
    {
//

        $sql    = "SELECT * FROM `store` WHERE sid=$id";
        $data   = DB::select($sql);
        $sql    = "SELECT role FROM `role` WHERE sid=$id";
        $data2  = DB::select($sql);
        $sql    = "SELECT COUNT(*) sum FROM `storelike` WHERE sid=$id";
        $like   = DB::select($sql);
        $sql    = "SELECT  IFNULL(ROUND(AVG(votes),1),0) vote , COUNT(votes) sum FROM `storecmt` RIGHT JOIN store USING(sid) WHERE sid=$id GROUP BY sid";
        $vote   = DB::select($sql);
        $sql    = "SELECT  u.name,c.uid ,votes,cmt, c.created_at  FROM `storecmt`  c  JOIN store  s USING(sid)   JOIN users u ON c.uid=u.id WHERE sid=$id ORDER BY c.created_at DESC"  ;
        $cmt    = DB::select($sql);
        $uid    = Auth::user()->id;
        $sql    = "SELECT sid FROM `storelike` WHERE sid=$id AND $uid=uid";
        $islike = DB::select($sql);
        return view('storeinfo', compact('data', 'data2', 'vote', 'like', 'cmt', 'islike', 'id'));
        //return $islike;
    }

    public function like($id, $like)
    {
//
        $uid = Auth::user()->id;
        if ($like === "like") {
            $sql  = "INSERT INTO `storelike`(`uid`, `sid`) VALUES ($uid,$id)";
            $data = DB::insert($sql);
        } else {
            $sql  = "DELETE FROM `storelike` WHERE sid=$id AND $uid=uid";
            $data = DB::delete($sql);
        }
        return redirect('/storeinfo/' . $id);
        //return $cmt;
    }

    public function cmtstore(Request $request)
    {
//
        $uid = Auth::user()->id;
        $data = $request->validate([
            'point'    => ['required'],
            'comment' => ['required'],
        ]);
        $time=now();

        $sql  = "INSERT INTO `storecmt`(`uid`, `sid`, `cmt`, `votes`, `created_at`) VALUES ($uid,$request->sid,'$request->comment ',$request->point,now())";
        $cmt= DB::insert($sql);
        

        return redirect('/storeinfo/' . $request->sid);;
    }

     public function signstore()
    {
//
        $uid = Auth::user()->id;
        $data = $request->validate([
        'storename' => ['required','string','max:255'],
        'address' => ['required','string','max:255'],
        ]);
        $time=now();

        $sql  = "INSERT INTO `storecmt`(`uid`, `sid`, `cmt`, `votes`, `created_at`) VALUES ($uid,$request->sid,'$request->comment ',$request->point,now())";
        $cmt= DB::insert($sql);
        

        return redirect('/storeinfo/' . $request->sid);;
    }
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create()
    {
//
    }
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request)
    {
//
    }
/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id)
    {
//
    }
/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
//
    }
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, $id)
    {
//
    }
/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy($id)
    {
//
    }
}